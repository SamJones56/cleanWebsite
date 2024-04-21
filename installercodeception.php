<?php

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

setupEnvironment();
process(is_array($argv) ? $argv : array());

/**
 * Initializes various values
 *
 * @throws RuntimeException If uopz extension prevents exit calls
 */
function setupEnvironment()
{
    ini_set('display_errors', 1);

    if (extension_loaded('uopz') && !(ini_get('uopz.disable') || ini_get('uopz.exit'))) {
        // uopz works at opcode level and disables exit calls
        if (function_exists('uopz_allow_exit')) {
            @uopz_allow_exit(true);
        } else {
            throw new RuntimeException('The uopz extension ignores exit calls and breaks this installer.');
        }
    }

    $installer = 'ComposerInstaller';

    if (defined('PHP_WINDOWS_VERSION_MAJOR')) {
        if ($version = getenv('COMPOSERSETUP')) {
            $installer = sprintf('Composer-Setup.exe/%s', $version);
        }
    }

    define('COMPOSER_INSTALLER', $installer);
}

/**
 * Processes the installer
 */
function process($argv)
{
    // Determine ANSI output from --ansi and --no-ansi flags
    setUseAnsi($argv);

    $help = in_array('--help', $argv) || in_array('-h', $argv);
    if ($help) {
        displayHelp();
        exit(0);
    }

    $check      = in_array('--check', $argv);
    $force      = in_array('--force', $argv);
    $quiet      = in_array('--quiet', $argv);
    $channel    = 'stable';
    if (in_array('--snapshot', $argv)) {
        $channel = 'snapshot';
    } elseif (in_array('--preview', $argv)) {
        $channel = 'preview';
    } elseif (in_array('--1', $argv)) {
        $channel = '1';
    } elseif (in_array('--2', $argv)) {
        $channel = '2';
    } elseif (in_array('--2.2', $argv)) {
        $channel = '2.2';
    }
    $disableTls = in_array('--disable-tls', $argv);
    $installDir = getOptValue('--install-dir', $argv, false);
    $version    = getOptValue('--version', $argv, false);
    $filename   = getOptValue('--filename', $argv, 'composer.phar');
    $cafile     = getOptValue('--cafile', $argv, false);

    if (!checkParams($installDir, $version, $cafile)) {
        exit(1);
    }

    $ok = checkPlatform($warnings, $quiet, $disableTls, true);

    if ($check) {
        // Only show warnings if we haven't output any errors
        if ($ok) {
            showWarnings($warnings);
            showSecurityWarning($disableTls);
        }
        exit($ok ? 0 : 1);
    }

    if ($ok || $force) {
        if ($channel === '1' && !$quiet) {
            out('Warning: You forced the install of Composer 1.x via --1, but Composer 2.x is the latest stable version. Updating to it via composer self-update --stable is recommended.', 'error');
        }

        $installer = new Installer($quiet, $disableTls, $cafile);
        if ($installer->run($version, $installDir, $filename, $channel)) {
            showWarnings($warnings);
            showSecurityWarning($disableTls);
            exit(0);
        }
    }

    exit(1);
}

/**
 * Displays the help
 */
function displayHelp()
{
    echo <<<EOF
Composer Installer
------------------
Options
--help               this help
--check              for checking environment only
--force              forces the installation
--ansi               force ANSI color output
--no-ansi            disable ANSI color output
--quiet              do not output unimportant messages
--install-dir="..."  accepts a target installation directory
--preview            install the latest version from the preview (alpha/beta/rc) channel instead of stable
--snapshot           install the latest version from the snapshot (dev builds) channel instead of stable
--1                  install the latest stable Composer 1.x (EOL) version
--2                  install the latest stable Composer 2.x version
--2.2                install the latest stable Composer 2.2.x (LTS) version
--version="..."      accepts a specific version to install instead of the latest
--filename="..."     accepts a target filename (default: composer.phar)
--disable-tls        disable SSL/TLS security for file downloads
--cafile="..."       accepts a path to a Certificate Authority (CA) certificate file for SSL/TLS verification

EOF;
}

/**
 * Sets the USE_ANSI define for colorizing output
 *
 * @param array $argv Command-line arguments
 */
function setUseAnsi($argv)
{
    // --no-ansi wins over --ansi
    if (in_array('--no-ansi', $argv)) {
        define('USE_ANSI', false);
    } elseif (in_array('--ansi', $argv)) {
        define('USE_ANSI', true);
    } else {
        define('USE_ANSI', outputSupportsColor());
    }
}

/**
 * Returns whether color output is supported
 *
 * @return bool
 */
function outputSupportsColor()
{
    if (false !== getenv('NO_COLOR') || !defined('STDOUT')) {
        return false;
    }

    if ('Hyper' === getenv('TERM_PROGRAM')) {
        return true;
    }

    if (defined('PHP_WINDOWS_VERSION_BUILD')) {
        return (function_exists('sapi_windows_vt100_support')
                && sapi_windows_vt100_support(STDOUT))
            || false !== getenv('ANSICON')
            || 'ON' === getenv('ConEmuANSI')
            || 'xterm' === getenv('TERM');
    }

    if (function_exists('stream_isatty')) {
        return stream_isatty(STDOUT);
    }

    if (function_exists('posix_isatty')) {
        return posix_isatty(STDOUT);
    }

    $stat = fstat(STDOUT);
    // Check if formatted mode is S_IFCHR
    return $stat ? 0020000 === ($stat['mode'] & 0170000) : false;
}

/**
 * Returns the value of a command-line option
 *
 * @param string $opt The command-line option to check
 * @param array $argv Command-line arguments
 * @param mixed $default Default value to be returned
 *
 * @return mixed The command-line value or the default
 */
function getOptValue($opt, $argv, $default)
{
    $optLength = strlen($opt);

    foreach ($argv as $key => $value) {
        $next = $key + 1;
        if (0 === strpos($value, $opt)) {
            if ($optLength === strlen($value) && isset($argv[$next])) {
                return trim($argv[$next]);
            } else {
                return trim(substr($value, $optLength + 1));
            }
        }
    }

    return $default;
}

/**
 * Checks that user-supplied params are valid
 *
 * @param mixed $installDir The required istallation directory
 * @param mixed $version The required composer version to install
 * @param mixed $cafile Certificate Authority file
 *
 * @return bool True if the supplied params are okay
 */
function checkParams($installDir, $version, $cafile)
{
    $result = true;

    if (false !== $installDir && !is_dir($installDir)) {
        out("The defined install dir ({$installDir}) does not exist.", 'info');
        $result = false;
    }

    if (false !== $version && 1 !== preg_match('/^\d+\.\d+\.\d+(\-(alpha|beta|RC)\d*)*$/', $version)) {
        out("The defined install version ({$version}) does not match release pattern.", 'info');
        $result = false;
    }

    if (false !== $cafile && (!file_exists($cafile) || !is_readable($cafile))) {
        out("The defined Certificate Authority (CA) cert file ({$cafile}) does not exist or is not readable.", 'info');
        $result = false;
    }
    return $result;
}

/**
 * Checks the platform for possible issues running Composer
 *
 * Errors are written to the output, warnings are saved for later display.
 *
 * @param array $warnings Populated by method, to be shown later
 * @param bool $quiet Quiet mode
 * @param bool $disableTls Bypass tls
 * @param bool $install If we are installing, rather than diagnosing
 *
 * @return bool True if there are no errors
 */
function checkPlatform(&$warnings, $quiet, $disableTls, $install)
{
    getPlatformIssues($errors, $warnings, $install);

    // Make openssl warning an error if tls has not been specifically disabled
    if (isset($warnings['openssl']) && !$disableTls) {
        $errors['openssl'] = $warnings['openssl'];
        unset($warnings['openssl']);
    }

    if (!empty($errors)) {
        // Composer-Setup.exe uses "Some settings" to flag platform errors
        out('Some settings on your machine make Composer unable to work properly.', 'error');
        out('Make sure that you fix the issues listed below and run this script again:', 'error');
        outputIssues($errors);
        return false;
    }

    if (empty($warnings) && !$quiet) {
        out('All settings correct for using Composer', 'success');
    }
    return true;
}

/**
 * Checks platform configuration for common incompatibility issues
 *
 * @param array $errors Populated by method
 * @param array $warnings Populated by method
 * @param bool $install If we are installing, rather than diagnosing
 *
 * @return bool If any errors or warnings have been found
 */
function getPlatformIssues(&$errors, &$warnings, $install)
{
    $errors = array();
    $warnings = array();

    if ($iniPath = php_ini_loaded_file()) {
        $iniMessage = PHP_EOL . 'The php.ini used by your command-line PHP is: ' . $iniPath;
    } else {
        $iniMessage = PHP_EOL . 'A php.ini file does not exist. You will have to create one.';
    }
    $iniMessage .= PHP_EOL . 'If you can not modify the ini file, you can also run `php -d option=value` to modify ini values on the fly. You can use -d multiple times.';

    if (ini_get('detect_unicode')) {
        $errors['unicode'] = array(
            'The detect_unicode setting must be disabled.',
            'Add the following to the end of your `php.ini`:',
            '    detect_unicode = Off',
            $iniMessage
        );
    }

    if (extension_loaded('suhosin')) {
        $suhosin = ini_get('suhosin.executor.include.whitelist');
        $suhosinBlacklist = ini_get('suhosin.executor.include.blacklist');
        if (false === stripos($suhosin, 'phar') && (!$suhosinBlacklist || false !== stripos($suhosinBlacklist, 'phar'))) {
            $errors['suhosin'] = array(
                'The suhosin.executor.include.whitelist setting is incorrect.',
                'Add the following to the end of your `php.ini` or suhosin.ini (Example path [for Debian]: /etc/php5/cli/conf.d/suhosin.ini):',
                '    suhosin.executor.include.whitelist = phar ' . $suhosin,
                $iniMessage
            );
        }
    }

}