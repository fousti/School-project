include_recipe "apache2"

web_app "example" do
  server_name "www.example.me"
  server_aliases ["example.me"]
  directory_index ["index.php"]
  allow_override "all"
  docroot "/var/www/"
end
