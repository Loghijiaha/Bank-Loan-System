CREATE TABLE IF NOT EXISTS Branch(
    branch_code varchar(10) PRIMARY KEY,
    name varchar(20),
    location varchar(50)
);


CREATE TABLE IF NOT EXISTS Employee(
    emp_id varchar(10) PRIMARY KEY,
    name varchar(20),
    branch_code varchar(10),
    department ENUM('accounts','loan','customer relations','administration'),
    FOREIGN KEY (branch_code) REFERENCES Branch(branch_code)    
);


CREATE TABLE IF NOT EXISTS Manager(
    manager_id varchar (10) PRIMARY KEY,
    FOREIGN KEY (manager_id) REFERENCES Employee(emp_id)
);

CREATE TABLE IF NOT EXISTS Customer(
    customer_id varchar(20) PRIMARY KEY,
    number varchar(4),
    road_name varchar(20),
    city varchar(20),
    address varchar(50) AS (concat_ws(number,' ',road_name,' ',city)),
    phone_number int(10));

CREATE TABLE IF NOT EXISTS Individual(
    customer_id varchar(20) PRIMARY KEY,
    first_name varchar(20),
    last_name varchar(20),
    name varchar(20) AS (concat_ws(first_name,' ',last_name)),
    DOB date,
    age int(3),
    nationality varchar(10),
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id));

CREATE TABLE IF NOT EXISTS child(
    guardian_customer_id varchar(10) PRIMARY KEY,
    customer_id varchar(10),
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id));
    
CREATE TABLE IF NOT EXISTS adult(
    NIC_no varchar(10) PRIMARY KEY,
    customer_id varchar(10),
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id));
    


CREATE TABLE IF NOT EXISTS organisation(
    customer_id varchar(10) PRIMARY KEY,
    name varchar(20),
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id));

CREATE TABLE IF NOT EXISTS normal(
    emp_id varchar(10) PRIMARY KEY,
    manager_id varchar(10),
    FOREIGN KEY (emp_id) REFERENCES employee(emp_id),
    FOREIGN KEY (manager_id) REFERENCES manager(manager_id));

CREATE TABLE IF NOT EXISTS Loan(
    loan_id varchar(10) PRIMARY KEY,
    customer_id varchar(10),
    purpose varchar(30),
    loan_amount float(8,2),
    balance_amount float(9,2),
    period varchar(6),
    interest_rate int(2),
    no_of_installments int(3),
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id));

 CREATE TABLE IF NOT EXISTS loan_customer(
     loan_cus_id varchar(10) PRIMARY KEY,
     customer_id varchar(10),
     basic_income float(7,2),
     fixed_allowance float(6,2),
     variable_income float(7,2),
     employment_type varchar(20),
     service_period varchar(10),
     over_due_advances float(5,2),
     FOREIGN KEY (customer_id) REFERENCES Customer(customer_id));

CREATE TABLE IF NOT EXISTS repayment(
    repayment_id varchar(10) PRIMARY KEY,
    loan_id varchar(10),
    amount float(6,2),
    deadline date,
    settled_date date,
    FOREIGN KEY (loan_id) REFERENCES Loan(loan_id));

CREATE TABLE IF NOT EXISTS account(
    account_number varchar(10) PRIMARY KEY,
    first_name varchar(20),
    last_name varchar(20),
    customer_name varchar(20) AS (concat_ws(first_name,' ',last_name)),
    date_opened date,
    account_balance float(8,2),
    branch_code varchar(10),
    customer_id varchar(10),
    minimum_balance float(4,2),
    FOREIGN KEY (branch_code) REFERENCES branch(branch_code),
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id));
    
CREATE TABLE IF NOT EXISTS savingplan(
    plan_id varchar(10) PRIMARY KEY,
    interest_rate int(2),
    minimum_amount float(4,2));

CREATE TABLE IF NOT EXISTS savings(
    plan_id varchar(10) PRIMARY KEY,
    no_of_withdrawals int(5),
    FOREIGN KEY (plan_id) REFERENCES savingplan(plan_id));

CREATE TABLE IF NOT EXISTS card(
    card_id varchar(20) PRIMARY KEY,
    account_number varchar(10),
    pin int(4),
    FOREIGN KEY (account_number) REFERENCES account(account_number));

CREATE TABLE IF NOT EXISTS atm(
    atm_id varchar(10) PRIMARY KEY,
    location varchar(20));

CREATE TABLE IF NOT EXISTS onlineaccount(
    online_account_id varchar(20) PRIMARY KEY,
    account_number varchar(20),
    FOREIGN KEY (account_number) REFERENCES account(account_number));

CREATE TABLE IF NOT EXISTS TRANSACTION(
    transaction_id varchar(10) PRIMARY KEY,
    date_of_transaction date,
    referene int(7),
    amount float(5,2));

CREATE TABLE IF NOT EXISTS ONLINETRANSACTION(
    from_account_id varchar(20),
    to_account_id varchar(20));

CREATE TABLE IF NOT EXISTS FDplan(
    plan_id varchar(10) PRIMARY KEY,
    interest_rate int(2),
    duration varchar(10));
    

CREATE TABLE IF NOT EXISTS fixeddeposit(
    deposit_id varchar(10) PRIMARY KEY,
    branch_code varchar(10),
    deposit_amount float(9,2),
    account_number varchar(20),
    plan_id varchar(10),
    FOREIGN KEY (branch_code) REFERENCES branch(branch_code),
    FOREIGN KEY (account_number) REFERENCES account(account_number),
    FOREIGN KEY (branch_code) REFERENCES branch(branch_code));

DELIMITER //

CREATE TRIGGER balance_check BEFORE INSERT on account
For EACH ROW
    BEGIN
        IF NEW.account_balance < NEW.minimum_balance
        THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Incorrect balance';
          END IF;
    END;
//
  

