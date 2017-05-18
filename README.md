# Antares Logger Module

[![Laravel 5.4](https://img.shields.io/badge/Laravel-5.4-orange.svg)](http://laravel.com)
[![Coverage Status](https://coveralls.io/repos/github/antaresproject/project/badge.svg?branch=master)](https://coveralls.io/github/antaresproject/project?branch=master)
[![Build Status](https://travis-ci.org/antaresproject/project.svg?branch=master)](https://travis-ci.org/antaresproject/project)
[![Code Climate](https://codeclimate.com/github/antaresproject/project/badges/gpa.svg)](https://codeclimate.com/github/antaresproject/project)
[![GitHub issues](https://img.shields.io/github/issues/antaresproject/project.svg)](https://github.com/antaresproject/project/issues)
[![GitHub forks](https://img.shields.io/github/forks/antaresproject/project.svg)](https://github.com/antaresproject/project/network)
[![GitHub stars](https://img.shields.io/github/stars/antaresproject/project.svg)](https://github.com/antaresproject/project/stargazers)
[![GitHub license](https://img.shields.io/badge/license-New%20BSD-blue.svg)](https://raw.githubusercontent.com/antaresproject/project/master/LICENSE)

![logger](docs/img/logger.PNG)

Logger is a module responsible for gathering and displaying logs coming from multiple parts of the system and other modules. It covers:

   - Activity log - events related to objects in the system. E.g. changing user details.
   - Error log - application errors with detailed information for easier debugging.
   - Request log - all the HTTP requests to the application.
   - Automation log - logs of the <u>Automation</u> module.
   - Notification log - all the notifications sent to users by <u>Notification</u> module.
   
It is recommended to link all the custom modules to Logger so browsing it is simple, consistent and includes all the helpful information needed for troubleshooting.

## Documentation

Antares Logger Module documentation [antaresproject.io/docs/core_modules/logger](http://antaresproject.io/docs/site/core_modules/logger/).

Full Antares documentation can be found at [antaresproject.io/docs](http://antaresproject.io/docs).


## Changelog

Antares Logger changelog can be found in release notes [antaresproject.io/docs/site/getting_started/changelog/#logger](http://antaresproject.io/docs/site/getting_started/changelog/index.html#logger).

You can find full Antares changelog in Antares Documentation [antaresproject.io/docs/site/getting_started/changelog](http://antaresproject.io/docs/site/getting_started/changelog/index.html).

## Issues

The issue list of this repo is **exclusively** for bug reports and feature requests.

Please follow [Issue Reporting Guide](http://antaresproject.io/docs/site/getting_started/issues_reporting_guide/index.html) before opening an issue. Issues not following the guide will be closed without further investigation.

## Contribution

Please follow [Contribution Guide](http://antaresproject.io/docs/site/getting_started/contributing/index.html) before making a pull request.

## Community

* Twitter: @antaresproject
* Forum: (coming soon)
* Blog: (coming soon)
* Email: contact (at) antaresproject.io


## License

This software is released under the BSD 3-Clause License.

© 2017 INBS.Software , all rights reserved.
