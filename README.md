
# 👕 GABC Exam

I created a simple MVC-like framework to create the application on my own. It is composed of:

- Route Processing
- Controller
- Repository (Pattern)
- Model
- View (Client)


## ⚙️System Requirement

**Server:** Apache | NGINX, PHP 7, MySQL

## 🧩 JQuery Library Used

- [ Bootstrap 5.3 ](https://getbootstrap.com "Bootstrap 5.3")
- [ Select2 ](https://select2.org/ "Select2")
- [ DataTable ](https://datatables.net/ "Select2")
- [ Responsive-Tabs ](https://jellekralt.github.io/Responsive-Tabs "Responsive-Tabs")
- [ Font-Awesome 4.7 ](https://fontawesome.com/v4/icons/ "Font-Awesome 4.7")
- [ SweetAlert ](https://sweetalert.js.org/ "SweetAlert")


## 🛠 Skills
PHP, HTML, CSS, Vanila JS, JQuery


## 📌 Installation

- Copy or clone the folder project to your PHP server folder lookup.
Note: Note: In my case, I use [ XAMPP ](https://www.apachefriends.org/ "xampp"), so I just put the project in the ``` htdocs ``` or ``` www ``` if you are using [ WAMP ](https://www.apachefriends.org/ "wamp")

- Import the gabc.sql file for the table schematic and stored procedure.

```
sql/gabc.sql
```
- Note: I currently use my local on creating this project and named my database ``` gabc ```, If you wish to change the database name, you may want to look into

```
config/database.php
```

- To change the default database settings, such as MySQL Server Host, Username, Password, and Database Name

- Make sure that the folder ```uploads``` has a write permission.


## 📁Folder Structure Diagrams

```
├── assets
├── config
│   └── database.php
│   └── request.php
│   └── route.php
│   └── session.php
├── controller
│   └── branch_controller.php
│   └── employee_controller.php
├── model
│   └── branch_db.php
│   └── employee_db.php
├── repository
│   └── gabc_repository.php
├── sql
│   └── gabc.sql
├── uploads
└── view
│   └── branch
│   │   └── create.php
│   │   └── list.php
│   └── employee
│   │   └── list.php
│   └── error.php
│   └── footer.php
│   └── header.php
└── index.php
└── README.md
```


## 🖼️ Screenshots

### Branch List

![App Screenshot](https://i.ibb.co/1qnkL8N/download.png)

### Branch Form

![App Screenshot](https://i.ibb.co/w6Kq0BG/download-1.png)

### Employee List


![App Screenshot](https://i.ibb.co/1002jjF/download-2.png)

### Employee Form


![App Screenshot](https://i.ibb.co/HT3yy6y/download-3.png)
## 📚 Lessons Learned

- Doing this project made me realize the advantage of the currently available PHP framework.

Worries are that the task dictates that the content of the datatable would use JQuery to populate, yet I may just be confused about whether I will use a simple http request for the content and loop the data, then add table rows and columns to the table, or what I've done is use the server-side fetch built-in plugins on the DataTable.

