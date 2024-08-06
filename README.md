## Dev

### Сборка
```shell
    docker build -f ./ci/dockerfiles/dockerfile-app-franken-dev -t additional-product-store .
```
Запуск
```shell
docker run -d --rm\
 -p 8456:80 \
 -v ${PWD}:/app \
 -e APP_ENV=dev \
 -e DATABASE_DSN="DATABASE_DSN" \
 -e REDIS_HOST="REDIS_HOST" \
 -e SHELL_VERBOSITY="2" \
 --name running-additional-product-store additional-product-store:latest
```    

## Prod и test

### Сборка
```shell
    docker build -f ./ci/dockerfiles/dockerfile-app-franken-prod -t additional-product-store .
```

### Запуск
```shell
docker run -d --rm 
 -p 8456:80 \
 -e APP_ENV=prod \
 -e DATABASE_DSN="DATABASE_DSN" \
 -e REDIS_HOST="REDIS_HOST" \
 -e SHELL_VERBOSITY="2" \
 --name running-additional-product-store additional-product-store
```    

## Health check (проверка)

Liveness

```shell
curl https://localhost/healthz/l
```

Readness

```shell
curl https://localhost/healthz/r
```

Swagger

```shell
https://localhost/api/doc
```
