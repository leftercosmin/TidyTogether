# why?

you may find strage to store vectors inside of php files. but there is a good reason: styling.
creating `<img>` tags only allow inline styling of the svgs. calling in php `require "view/components/svg/file.php"` allows them to inherit styles.
