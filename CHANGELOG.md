# Changelog
All notable changes to this project will be documented in this file.

## 11.0.0 - 2026-05-26

### Added
- Laravel 13 support

## 10.0.0 - 2025-07-29

### Added
- Laravel 12 support

## 9.0.0 - 2024-12-06

### Added
- Laravel 11 support

## 8.0.0 - 2024-04-10

### Added
- Support for Laravel 10

### Removed
- Support for older Laravel versions

## 7.0.0 - 2023-10-29

### Removed
- Extranous check in middleware which checked if tenants existed for the current user.
- `creating` global events which automatically added the `tenants`or `tenant` relation if not set, due to it breaking tests, being obscure and never being used. Created more confusion and complexity than help.
- Extranous doc blocks

### Fixed
- Wrong snamespace for service classes (not being used?)


### Changed
- Aborts to `403` instead of `401` if user has no access to the tenant, or no tenants.

## 6.0.0 - 2023-12-13

### Changed
- Include rows with `tenant_id` set to `null` when querying for any tenant 

### Added
- Laravel 9 support

## 5.0.0 - 2022-09-04

### Added
- Laravel 9 support

### Removed
- Support for older Laravel versions

## 4.1.0 - 2022-02-21

### Added
- Tenant indetifier to config
- Global scopes for many to many relations
- tenant_user pivot table

### Changed
- Rename cache key

## 4.0.0 - 2021-06-06

### Changed
- Allow users to belong to one tenant

## 3.1.0 - 2021-02-16

## 3.0.0 - 2021-01-26

### Changed
- Allow users to belong to multiple tenants

## 2.0.0 - 2020-06-21

### Changed
- Identify on column 'slug'

## 1.2.2 - 2020-06-21

### Changed
- Package name
