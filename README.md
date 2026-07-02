Sensio Event
============

## Install

```console
$ git clone https://github.com/adrienroches-sensio/sf_ux.2026.07.06.git
$ cd ./sf_ux.2026.07.06
$ symfony composer install
$ symfony console doctrine:migration:migrate --allow-no-migration --no-interaction
$ symfony console doctrine:fixtures:load --no-interaction
$ symfony serve
```

## Log in

| email                 | password  | roles          |
|-----------------------|-----------|----------------|
| nobody@example.com    | nobody    |                |
| user@example.com      | user      | ROLE_USER      |
| website@example.com   | website   | ROLE_WEBSITE   |
| organizer@example.com | organizer | ROLE_ORGANIZER |
| admin@example.com     | admin     | ROLE_ADMIN     |
