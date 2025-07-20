# Mini File Manager

Mini File Manager is a lightweight and portable single-file PHP-based web file manager. This application enables basic file and folder management (upload, download, edit, delete, create, rename) directly from the browser, complete with a simple login system for access security.

## Features

* **Single File:** Easy to deploy, just upload one PHP file.
* **Authentication:** Basic username and password protection for access control.
* **File Browse:** Navigate through directories and view contents.
* **File Operations:**
    * **Upload:** Upload files from your local machine to the server.
    * **Download:** Download files from the server.
    * **View:** Display content of text-based files.
    * **Edit:** Modify the content of text files directly in the browser.
    * **Delete:** Remove files or folders (supports recursive deletion for folders).
    * **Create:** Create new empty files or folders.
    * **Rename:** Change names of files and folders.
* **Mass Actions:** Select multiple files/folders for mass deletion.
* **File Information:** Displays file size, permissions (rwx format), and last modified date.
* **Responsive UI:** Utilizes UIKit for a clean and responsive user interface.

## Installation

1.  **Download:** Save the `minifile.php` file to your local machine.
2.  **Upload:** Upload the `minifile.php` file to your web server in the desired directory where you want to manage files.
3.  **Access:** Open your web browser and navigate to the URL where you uploaded `minifile.php` (e.g., `http://yourdomain.com/minifile.php`).

## Usage

1.  **Login:** Upon first access, you will be prompted to log in.
    * **Default Username:** `admin`
    * **Default Password:** `rivensyx`
    * **_Important:_** Change these credentials immediately after deployment for security reasons.
2.  **Navigation:** Browse through directories using the breadcrumbs or by clicking on folder names.
3.  **File/Folder Actions:**
    * **Upload:** Use the "Upload" section to select and upload files.
    * **Create File/Folder:** Click "Create File" or "Create Folder" to add new items.
    * **Actions Column:** Use the "Actions" column for individual file/folder operations (Edit, Download, Delete, Rename).
    * **Mass Delete:** Use the checkboxes to select multiple items and the "Mass Delete" option to delete them simultaneously.

## Configuration

You can easily change the default login credentials by editing the `minifile.php` file. Look for the following lines at the top of the file:

```php
$password = 'rivensyx'; // Ubah password Anda disini
$user = 'admin'; // Ubah username Anda disini
