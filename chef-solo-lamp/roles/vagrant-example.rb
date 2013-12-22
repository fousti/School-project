name "vagrant-example"

default_attributes(
    "build_essential" => {
        "compiletime" => true
    }
)

override_attributes(
    "mysql" => {
        "server_root_password" => 'hariseldon',
        "server_repl_password" => 'hariseldon',
        "server_debian_password" => 'hariseldon'
    }
)

run_list(
    "recipe[apt]",
    "recipe[build-essential]",
    "recipe[openssl]",
    "recipe[apache2]",
    "recipe[apache2::mod_php5]",
    "recipe[mysql]",
    "recipe[mysql::server]",
    "recipe[php]",
    "recipe[php::module_mysql]",
    "recipe[apache2::vhosts]",
    "recipe[database::mysql]",
    "recipe[database::import]"
)
