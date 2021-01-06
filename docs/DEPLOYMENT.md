## Deployment Instructions

* Clone repository or un-compress a release archive:

`git clone https://github.com/comely-io/starter-app`

* Create temporary data directories:

`cp -r starter-app/tmp_sample starter-app/tmp`

* Give appropriate permissions to temp data directories:

`chmod -R 777 starter-app/tmp`

* Delete unnecessary `tmp_sample` directory:

`rm -rf starter-app/tmp_sample`

* Go inside source directory:

`cd starter-app/src`

* Copy configuration files:

`cp -r config_sample/ config/`

* Delete unnecessary `config_sample` directory:

`rm -rf config_sample`

* Edit all configuration files in a YAML compatible text editor.
* Make `console` file executable:

`chmod +x console`

* Run composer installation

`composer install`

* Confirm all prerequisites from CLI: 

`./console check_requirements`
