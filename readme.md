
# Backend da aplicação

Teste tecnico para merchion

A aplicação é uma API desenvolvida em Symfony, utilizando MySQL como banco de dados. O ambiente de desenvolvimento é configurado com Docker, garantindo uma configuração padronizada para todos que desejam contribuir com o projeto e realizar testes. 


## Configurações necessárias

Para executar o projeto localmente, são necessárias algumas configurações. Como o objetivo é didático, optei por deixar as variáveis de ambiente expostas, considerando que a aplicação roda apenas em ambiente local.






## Rodando localmente

Clone o projeto

```bash
  git clone https://github.com/ededias/merchion-backend.git
```

Entre no diretório do projeto

```bash
  cd merchion-backend
```

Altere o `.env.dev` para `.env`

Instale as dependências

```bash
  composer install
```

Para gerar as chaves publicas e privadas do jwt exute o seguinte comando, recomendo executar dentro do ambiente docker para não ter erro. Para acessar o ambiete docker execute o seguite comand `docker exec -it php bash
`

```bash
    php bin/console lexik:jwt:generate-keypair
```

Caso opte por iniciar o projeto utilizando o servidor do próprio symfony é só rodar o seguinte comando.

```bash
  symfony server:start
```

Caso opte por iniciar o projeto utilizando do docker, isso irá iniciar o servidor.

```bash
  docker compose up -d --build
  ou
  docker-compose up -d --build
```

Verifique se as variáveis de ambiente estão corretamente configuradas, especialmente as relacionadas ao banco de dados. Se estiver utilizando Docker, o host do servidor deve ser `mysql`. Caso esteja rodando o Symfony diretamente, utilize `127.0.0.1` ou ajuste conforme o destino desejado para o banco de dados.




