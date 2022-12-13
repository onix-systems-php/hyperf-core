# Hyperf-core component

Includes the following general usage classes:

- Command:
    - AnonymizeDataCommand.
- DTO:
    - AbstractDTO;
    - PaginationRequestDTO;
    - PaginationResultDTO.
- Model:
    - AbstractModel;
    - AbstractFilter.
- Repository:
    - AbstractRepository.
- Service:
    - AnonymizeDataService;
    - Service #[Attribute].

Install:
```shell script
composer require onix-systems-php/hyperf-core
```

Publish anonymization config:
```shell script
php bin/hyperf.php vendor:publish onix-systems-php/hyperf-core
```
