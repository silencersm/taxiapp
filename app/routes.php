<?php

$app->get('/api/v1/hello/{name}', 'DriverController:index');
$app->get('/api/v1/driver/{driverId}/trips', 'TripController:getDriverTripsAction');
$app->get('/api/v1/customer/{customerId}/trips', 'TripController:getCustomerTripsAction');
$app->get('/api/v1/trip/vehicle/{vehicleId}/driver', 'TripController:getCarDriverDetailsAction');
$app->get('/api/v1/license/driver/{driverId}/vehicle/{vehicleId}/validate', 'LicenseController:validateDriverLicenseAction');