# ToDoList2018
This is the Deployment Guide for my ToDo Web Application. Steps 1-3 can be skipped if
you already have WAMP Server installed. This guide is for local deployment only.

1.  Download WAMP Server from http://www.wampserver.com/en/

2.  Run the installer to install it on your Windows machine.

3.  Follow the on-screen instructions.

4.  Double-click the WAMP Server icon on your computer to run WAMP Server.

5.  Clone the ToDoList2018 directory in the C:\wamp64\www directory.

6.  Open Windows Command Prompt.

7.  Navigate to the following directory in the command prompt: C:\Program Files\MySQL\MySQL Server 5.7\bin
    Note that the exact file path may be different on your computer. Your MySQL version # might also be different.

8.  Type the following command, and then press ENTER: mysql -u root -p
    Type your MySQL root password, and then press ENTER.

9.  Type the following command, and then press ENTER: GRANT ALL PRIVILEGES ON *.* TO 'todouser'@'localhost' IDENTIFIED BY 'todopass';

10. Type the following command, and then press ENTER: exit;

11. Type the following command, and then press ENTER: mysql -u todouser -p
    Type the following password, and then press ENTER: todopass

12. Type the following command, and then press ENTER: CREATE DATABASE todo_2018;

13. Open a web browser.

14. Enter the following URL in the address bar: localhost/ToDoList2018/