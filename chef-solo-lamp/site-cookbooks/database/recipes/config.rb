include_recipe "database::mysql"

mysql_connection_info = {
    :host => "localhost",
    :username => 'root',

    :password => node['mysql']['server_root_password']
}
#Create a DB called my_database
mysql_database 'my_database' do
  connection mysql_connection_info
  action :create
end
