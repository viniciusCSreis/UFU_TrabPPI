docker-compose -f docker/docker-compose.yml up -d
echo "esperando 60 segundos ate os servidores ligarem para enviar o comando sql:"
sleep 60 && mysql -w -h 192.168.70.2 < banco/setup.sql
mysql -w -h 192.168.70.2 < banco/insert.sql
echo "Site -> 192.168.70.4(usuario:teste@ufu.br senha:oi)"
echo "PhpMyAdmin -> 192.168.70.3 (usuario:vinicius senha:password) "
echo "Precione Enter para desligar os servidores"
read Letra
docker-compose -f docker/docker-compose.yml down
