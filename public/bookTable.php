<?php include "templates/header.php"; ?>

    <title>Dine</title>

    <form method="post">

        <label for="employee_id">employee_id</label>
        <input type="text" name="employee_id" id="employee_id" required><br>

        <label for="customer_id">customer_id</label>
        <input type="text" name="customer_id" id="customer_id" required><br>

        <label for="table_id">table_id</label><br>
        <input type="text" id="table_id" name="table_id" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone" required><br>

        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required><br>

        <label for="time">Time:</label><br>
        <input type="time" id="time" name="time" required><br>

        <label for="guests">Number of Guests:</label><br>
        <input type="number" id="guests" name="guests" required><br>

        <label for="special_requests">Special Requests:</label><br>
        <textarea id="special_requests" name="special_requests" rows="4" cols="50"></textarea><br>

        <input type="submit" name="submit" value="Submit">
    </form>

<?php include "templates/footer.php"; ?>