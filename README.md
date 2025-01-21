# Expendo

Expense Manager(Expendo) is a web application designed to help you manage and track your personal or business expenses efficiently. This README file provides setup instructions and details about the database structure for the application.

---

## Features
- Website With full user Login System
- Track income and expenses.
- Generate monthly reports with bar and charts.
- Categorize expenses for better insights.
- User-friendly interface for managing records.

---

## Installation Guide

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) or similar software with Apache and MySQL.
- Web browser (e.g., Chrome, Firefox).
- Code editor (optional, for development purposes).

### Steps

1. **Clone or Download the Project**
   - Clone the repository:
     ```bash
     git clone https://github.com/RonashDahal/Expendo.git
     ```
   - Or download the ZIP file and extract it.

2. **Move the Project Files**
   - Place the project folder in the `htdocs` directory of your XAMPP installation (e.g., `C:\xampp\htdocs\`).

3. **Import the Database**
   - Open [phpMyAdmin](http://localhost/phpmyadmin/) in your browser.
   - Create a new database named `dailyexpense`.
   - Import the two SQL files provided in the `database` folder:
     - `dailyexpense.sql` for the expense table structure.
     - `sucessquery.sql` for the profit table Structure.
     - Both Are necessary Otherwise it will give a fatal error.


4. **Start the Application**
   - Start Apache and MySQL from the XAMPP Control Panel.
   - Access the application in your browser at:
     ```
     http://localhost/
     ```

---

## Troubleshooting

- **Blank Page:** Check if the database connection details in `config.php` are correct.
- **SQL Import Error:** Ensure the SQL files are complete and you are importing them into a database named `expense_manager`.
- **Apache/MySQL Issues:** Restart XAMPP and ensure the services are running.

---

## Contributing
If you'd like to contribute to this project, feel free to create a pull request or open an issue on the [GitHub repository](https://github.com/RonashDahal/Expendo).

---

## License
This project is licensed under the MIT License. 

## Author
-Ronash Dahal
-for further clarification, mailto:techronash@gmail.com
