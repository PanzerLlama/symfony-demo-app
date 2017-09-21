# Domain-driven Symfony skeleton application

## Goals

- Built a bare minimum, yet working application
- Built domain layers flexible for common use cases

## Features

- Symfony application with security setup
- Event / command driven
- Shipped with `Doctrine` and `InMemory` persistence infrastructure
- `User` domain
  - E-mail / password based authentication
  - User registration / E-mail confirmation
  - Forgot password / Reset password / Change password
  - Primary / secondary e-mails
  - Disabled / enabled users
  - User roles

## Roadmap

- CLI tooling
- Configure access control / domain exception handling in HTTP
- Set a security token for pending users (?)
- Consider moving controllers / commands / forms to infra layer
- Add behavior / functional tests (!)
- Facebook / Two-factor / external authentication
- Concept of a `Profile` / `EAV` domain
- ...
