# Interactive-solutions\zf-stdlib

Contains useful utility classes that are compatible with Zend Framework, or with doctrine
that simplify our lifes as developer.

## Validators
A collection of custom validators that we are written, many of

#### InteractiveSolutions\Stdlib\Validator\(NoObjectExists|ObjectExists)
They are very very similar to the ones provided by `DoctrineORMModule` but they have an extra benefit
they do not require the injection of a repository into your input filters or custom factories. 
 
It's a simple factory that takes the argument `entity_name` that it uses to query the entity manager
for it's repository. 

#### InteractiveSolutions\Stdlib\Validator\DateNotExpiredValidator

Simply compares the provided datetime provided with the current timestamp


#### InteractiveSolutions\Stdlib\Validator\ArrayElementValidator

This validator applies the another validator to each time in the array provided by the validator.

#### InteractiveSolutions\Stdlib\Validator\AllEntitiesExistsValidator

A bit like the previous validator it applies a exists check to all the entities in the array
