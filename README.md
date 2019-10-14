# Sistema de clinicas AAPVR


## Documentação e Links uteis

1.  [Vue.js Tutorial](https://vuejs.org/v2/guide/)
2.  [Vuex - Gerenciamento de estado](https://vuex.vuejs.org)
3.  [Documentação Quasar](https://quasar.dev/introduction-to-quasar)
4.  [GitFlow](https://danielkummer.github.io/git-flow-cheatsheet/index.pt_BR.html) 

### Pacotes uteis

* [Laravel Permissions](https://github.com/spatie/laravel-permission)
* [Laravel Modules](https://github.com/nWidart/laravel-modules)            
* [Laravel Telescope - Debuging](https://laravel.com/docs/5.8/telescope)
* [Vuelidate](https://github.com/vuelidate/vuelidate)

# Instalação Laravel

## Após o download do repositorio, mova para o diretório 'api'
```bash
   cd api 
```

## Instale as dependencias
```bash
   composer install 
```

##  Copie o conteudo do arquivo .env.exemple para um arquivo .env
A partir dai, só será necessário configurar suas credenciais do banco de dados (por enquanto)

##  Crie a chave JWT
```bash
    php artisan jwt:secret
```

## Rode as Migrations do BD
```bash
    php artisan migrate
```

### Futuramente serão utilizados [seeders](https://laravel.com/docs/master/seeding) tanto em desenvolvimento quanto em produção, logo:
```bash
    php artisan migrate --seed
```

# Instalação Quasar 

## Instale o quasar-cli
```bash
npm install -g @quasar/cli
```
## Mova para o diretório da aplicação Front-end
```bash
cd quasar
```

## Instale as Dependencias
```bash
npm install
```

### Inicie o projeto em modo de desenvolvimento (hot-code reloading, error reporting, etc.)
```bash
quasar dev
```

### Lint the files
```bash
npm run lint
```

### Build the app for production
```bash
quasar build
```

### Customize the configuration
See [Configuring quasar.conf.js](https://quasar.dev/quasar-cli/quasar-conf-js).
