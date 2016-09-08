The Host Manager project is intended to provide a quick and easy solution for
developers to get started developing on a single XAMP stack. I have been working on multiple sites recently and have found that the performance of Vagrant is less than ideal. The goal of this tool is to make it easy to run all my local dev sites on a single XAMP stack. 

The tool provides a screen to manage your hosts file. It also provides a screen which can accept a domain name and a path to a web directory. A hosts file entry will be created and a vhost entry will be created for apache. So all you have to do is restart the server and you should be able to access the newly added site. Last but not least, fields are provided so you can also create a database, and database user for each site if need be.

The development of this tool was done using XAMPP using PHP 7. However, this tool
could easily be used with WAMP, LAMP, MAMP, or pretty much any other system
using Apache, PHP, and MySql.

This project requires a bit of setup. First things first, find the docroot for
your XAMP install. Since I'm using XAMPP on a Mac, mine is here:
/Applications/XAMPP/xamppfiles/htdocs/

I have removed XAMPP files from there and replaced them with the files from
host-manager. (Technically I used a sym link.)

Next, fill out the settings in settings.php. The tool will not work without
these values. I have versioned default values from XAMPP on a Mac, your setup may
be different.

Make a backup of you hosts file. If you are downloading this tool, it is
probably because you are looking for an easier way to manage your local sites. This tool will try to keep your existing hosts file intact, but not making any promises.

Make a backup of you existing XAMP config settings if you are currently using
them.

This tool is still a work in progress. The UI isn’t pretty (yet). There is no field validation (yet). There is no option to edit existing sites or host file entries (yet).

This tool is not intended for production use, so don’t get any ideas.