# PDF to Image

This simple website PHP repo will convert a PDF file to an image file. It uses the [Imagick](https://www.php.net/manual/en/book.imagick.php) PHP extension.

# Requirements

* PHP 7.4+
* [Imagick](https://www.php.net/manual/en/book.imagick.php) PHP extension
* [Composer](https://getcomposer.org/)
* [Ghostscript](https://www.ghostscript.com/) (for converting PDFs to images) **Specifically version 9.2.4**

# Hosting

This repo is designed to be hosted on a web server. On my local environment I have it running on [XAMPP PHP 8.1](https://www.apachefriends.org/) on Windows. Both Imagick and Ghostscript needed separate installations on my local environment.

# Installation

1. Clone this repo to your web server.
2. Run `composer install` in the root directory of the repo.
3. Install Imagick and Ghostscript on your web server.
4. Ensure that the `convert` command is available on your web server. This is the command that Ghostscript uses to convert PDFs to images. On Windows, you may have to go to your GS installation folder `C:\Program Files\gs\gs9.24\bin` and rename `gswin64.exe` to `gs.exe`. 

# Credits

The core functionality of converting PDFs to images is provided by the pdf-to-image library developed by Spatie.

## pdf-to-image by Spatie

* Repository: https://github.com/spatie/pdf-to-image
* License: MIT License

The MIT License (MIT) permits the use, modification, distribution, and sale of the software with the condition that the original copyright notice and license are included. Always ensure to respect and adhere to open-source licenses when using third-party tools and libraries.