INSERT INTO departments (dept_name, address)
VALUES ('Administration', 'HQ');

INSERT INTO user (name, address, ph_no, dob)
VALUES ('Admin', 'HQ', '0123456', '2024-01-01');

INSERT INTO login (email, password, permissionlvl)
VALUES ('admin@gmail.com', '123', 3);

INSERT INTO employee (user_id, dept_id, login_id, job)
VALUES (1, 1, 1, 'administrator');