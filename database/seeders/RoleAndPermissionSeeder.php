<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dashboard section Permission
        Permission::create(['name' => 'Dashboard']);

        // HR Section
        // Employee permissions
        Permission::create(['name' => 'Employee - All Employee']);
        Permission::create(['name' => 'Employee - Add New Employee']);
        Permission::create(['name' => 'Employee - View Employee']);
        Permission::create(['name' => 'Employee - Edit Employee']);
        Permission::create(['name' => 'Employee - Update Employee']);
        Permission::create(['name' => 'Employee - EnableDisable Employee']);
        Permission::create(['name' => 'Employee - Delete Employee']);
        Permission::create(['name' => 'Employee - Pdf All Employee']);

        // Company permissions
        Permission::create(['name' => 'Company - All Company']);
        Permission::create(['name' => 'Company - Add New Company']);
        Permission::create(['name' => 'Company - View Company']);
        Permission::create(['name' => 'Company - Edit Company']);
        Permission::create(['name' => 'Company - Update Company']);
        Permission::create(['name' => 'Company - Delete Company']);
        Permission::create(['name' => 'Company - Pdf All Company']);

        // Vehicles permissions
        Permission::create(['name' => 'Truck - All Truck']);
        Permission::create(['name' => 'Truck - Add New Truck']);
        Permission::create(['name' => 'Truck - View Truck']);
        Permission::create(['name' => 'Truck - Edit Truck']);
        Permission::create(['name' => 'Truck - Update Truck']);
        Permission::create(['name' => 'Truck - Delete Truck']);
        Permission::create(['name' => 'Truck - Pdf All Truck']);
        Permission::create(['name' => 'Trailer - All Trailer']);
        Permission::create(['name' => 'Trailer - Add New Trailer']);
        Permission::create(['name' => 'Trailer - View Trailer']);
        Permission::create(['name' => 'Trailer - Edit Trailer']);
        Permission::create(['name' => 'Trailer - Update Trailer']);
        Permission::create(['name' => 'Trailer - Delete Trailer']);
        Permission::create(['name' => 'Trailer - Pdf All Trailer']);

        // Maintenance
        Permission::create(['name' => 'Maintenance - Maintenance Log']);
        Permission::create(['name' => 'Maintenance - Inspections']);

        // User permissions
        Permission::create(['name' => 'User - All User']);
        Permission::create(['name' => 'User - Add New User']);
        Permission::create(['name' => 'User - View User']);
        Permission::create(['name' => 'User - Edit User']);
        Permission::create(['name' => 'User - Update User']);
        Permission::create(['name' => 'User - Store User']);
        Permission::create(['name' => 'User - ChangeStatus User']);
        Permission::create(['name' => 'User - StoreRole User']);
        Permission::create(['name' => 'User - RemoveRole User']);
        Permission::create(['name' => 'User - Delete User']);
        Permission::create(['name' => 'User - Pdf All User']);

        // UserProfile permissions
        Permission::create(['name' => 'UserProfile - View UserProfile']);
        Permission::create(['name' => 'UserProfile - Edit Name']);
        Permission::create(['name' => 'UserProfile - Edit Email']);
        Permission::create(['name' => 'UserProfile - Edit Password']);

        // End HR

        // Country permissions
        Permission::create(['name' => 'Country - All Country']);
        Permission::create(['name' => 'Country - Add New Country']);
        Permission::create(['name' => 'Country - View Country']);
        Permission::create(['name' => 'Country - Edit Country']);
        Permission::create(['name' => 'Country - Pdf Country']);
        Permission::create(['name' => 'Country - Delete Country']);

        // Province permissions
        Permission::create(['name' => 'Province - All Province']);
        Permission::create(['name' => 'Province - Add New Province']);
        Permission::create(['name' => 'Province - View Province']);
        Permission::create(['name' => 'Province - Edit Province']);
        Permission::create(['name' => 'Province - Pdf Province']);
        Permission::create(['name' => 'Province - Delete Province']);

        // District permissions
        Permission::create(['name' => 'District - All District']);
        Permission::create(['name' => 'District - Add New District']);
        Permission::create(['name' => 'District - View District']);
        Permission::create(['name' => 'District - Edit District']);
        Permission::create(['name' => 'District - Pdf District']);
        Permission::create(['name' => 'District - Delete District']);

        // District permissions
        Permission::create(['name' => 'Village - All Village']);
        Permission::create(['name' => 'Village - Add New Village']);
        Permission::create(['name' => 'Village - View Village']);
        Permission::create(['name' => 'Village - Edit Village']);
        Permission::create(['name' => 'Village - Pdf Village']);
        Permission::create(['name' => 'Village - Delete Village']);

        // Driver
        Permission::create(['name' => 'Driver - All Driver']);
        Permission::create(['name' => 'Driver - Add New Driver']);
        Permission::create(['name' => 'Driver - View Driver']);
        Permission::create(['name' => 'Driver - Edit Driver']);
        Permission::create(['name' => 'Driver - Update Driver']);
        Permission::create(['name' => 'Driver - ChangeStatus Driver']);
        Permission::create(['name' => 'Driver - Delete Driver']);
        Permission::create(['name' => 'Driver - Pdf Driver']);
        // End

        // Location 
        Permission::create(['name' => 'Location - All Location']);
        Permission::create(['name' => 'Location - Add New Location']);
        Permission::create(['name' => 'Location - View Location']);
        Permission::create(['name' => 'Location - Edit Location']);
        Permission::create(['name' => 'Location - Update Location']);
        Permission::create(['name' => 'Location - Delete Location']);
        Permission::create(['name' => 'Location - Pdf Location']);
        // End

        // WeightUnit 
        Permission::create(['name' => 'WeightUnit - All WeightUnit']);
        Permission::create(['name' => 'WeightUnit - Add New WeightUnit']);
        Permission::create(['name' => 'WeightUnit - View WeightUnit']);
        Permission::create(['name' => 'WeightUnit - Edit WeightUnit']);
        Permission::create(['name' => 'WeightUnit - Update WeightUnit']);
        Permission::create(['name' => 'WeightUnit - Delete WeightUnit']);
        Permission::create(['name' => 'WeightUnit - Pdf WeightUnit']);
        // End

        Permission::create(['name' => 'Load - All Load']);
        Permission::create(['name' => 'Load - Add New Load']);
        Permission::create(['name' => 'Load - View Load']);
        Permission::create(['name' => 'Load - Edit Load']);
        Permission::create(['name' => 'Load - Update Load']);
        Permission::create(['name' => 'Load - Delete Load']);
        Permission::create(['name' => 'Load - Pdf Load']);

        // Dispatch

        Permission::create(['name' => 'Dispatch - All Dispatch']);
        Permission::create(['name' => 'Dispatch - Add New Dispatch']);
        Permission::create(['name' => 'Dispatch - View Dispatch']);
        Permission::create(['name' => 'Dispatch - Edit Dispatch']);
        Permission::create(['name' => 'Dispatch - Update Dispatch']);
        Permission::create(['name' => 'Dispatch - Delete Dispatch']);
        Permission::create(['name' => 'Dispatch - Pdf Dispatch']);

        // Delivery & POD
        Permission::create(['name' => 'POD - All POD']);
        Permission::create(['name' => 'POD - Add New POD']);
        Permission::create(['name' => 'POD - View POD']);
        Permission::create(['name' => 'POD - Edit POD']);
        Permission::create(['name' => 'POD - Update POD']);
        Permission::create(['name' => 'POD - Delete POD']);

        // Expense
        Permission::create(['name' => 'Expense - All Expense']);
        Permission::create(['name' => 'Expense - Add New Expense']);
        Permission::create(['name' => 'Expense - View Expense']);
        Permission::create(['name' => 'Expense - Edit Expense']);
        Permission::create(['name' => 'Expense - Update Expense']);
        Permission::create(['name' => 'Expense - Delete Expense']);
        Permission::create(['name' => 'Expense - Pdf Expense']);

        // Truck Expense
        Permission::create(['name' => 'Truck Expense - All Truck Expense']);
        Permission::create(['name' => 'Truck Expense - Add New Truck Expense']);
        Permission::create(['name' => 'Truck Expense - View Truck Expense']);
        Permission::create(['name' => 'Truck Expense - Edit Truck Expense']);
        Permission::create(['name' => 'Truck Expense - Update Truck Expense']);
        Permission::create(['name' => 'Truck Expense - Delete Truck Expense']);
        Permission::create(['name' => 'Truck Expense - Pdf Truck Expense']);

        // Finance Users
        Permission::create(['name' => 'Finance - All Finance']);
        Permission::create(['name' => 'Finance - Add New Finance']);
        Permission::create(['name' => 'Finance - View Finance']);
        Permission::create(['name' => 'Finance - Edit Finance']);
        Permission::create(['name' => 'Finance - Update Finance']);
        Permission::create(['name' => 'Finance - Delete Finance']);

        // Roles & Permission Section
        // Permission
        Permission::create(['name' => 'Role - All Role']);
        Permission::create(['name' => 'Role - Add New Role']);
        Permission::create(['name' => 'Role - Edit Role']);
        Permission::create(['name' => 'Role - Delete Role']);

        Permission::create(['name' => 'Permission - All Permission']);
        Permission::create(['name' => 'Permission - Add New Permission']);
        Permission::create(['name' => 'Permission - Edit Permission']);
        Permission::create(['name' => 'Permission - Delete Permission']);


        // Super Admin role start
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        // Find the super admin user(s)
        $superAdminUsers = User::whereIn('id', [1, 2])->get();
        $superAdminPermissions = [
            // Dashboard section Permission
            'Dashboard',

            // Employee permissions
            'Employee - All Employee',
            'Employee - Add New Employee',
            'Employee - View Employee',
            'Employee - Edit Employee',
            'Employee - Update Employee',
            'Employee - EnableDisable Employee',
            'Employee - Delete Employee',
            'Employee - Pdf All Employee',

            // Company permissions
            'Company - All Company',
            'Company - Add New Company',
            'Company - View Company',
            'Company - Edit Company',
            'Company - Update Company',
            'Company - Delete Company',
            'Company - Pdf All Company',

            // Vehicles permissions
            'Truck - All Truck',
            'Truck - Add New Truck',
            'Truck - View Truck',
            'Truck - Edit Truck',
            'Truck - Update Truck',
            'Truck - Delete Truck',
            'Truck - Pdf All Truck',
            'Trailer - All Trailer',
            'Trailer - Add New Trailer',
            'Trailer - View Trailer',
            'Trailer - Edit Trailer',
            'Trailer - Update Trailer',
            'Trailer - Delete Trailer',
            'Trailer - Pdf All Trailer',

            // Maintenance
            'Maintenance - Maintenance Log',
            'Maintenance - Inspections',

            // User permissions
            'User - All User',
            'User - Add New User',
            'User - View User',
            'User - Edit User',
            'User - Update User',
            'User - Store User',
            'User - Delete User',
            'User - ChangeStatus User',
            'User - StoreRole User',
            'User - RemoveRole User',
            'User - Pdf All User',

            // User Profile permissions
            'UserProfile - View UserProfile',
            'UserProfile - Edit Name',
            'UserProfile - Edit Email',
            'UserProfile - Edit Password',

            // Country permissions
            'Country - All Country',
            'Country - Add New Country',
            'Country - View Country',
            'Country - Edit Country',
            'Country - Pdf Country',
            'Country - Delete Country',

            // Province permissions
            'Province - All Province',
            'Province - Add New Province',
            'Province - View Province',
            'Province - Edit Province',
            'Province - Pdf Province',
            'Province - Delete Province',

            // District permissions
            'District - All District',
            'District - Add New District',
            'District - View District',
            'District - Edit District',
            'District - Pdf District',
            'District - Delete District',

            // District permissions
            'Village - All Village',
            'Village - Add New Village',
            'Village - View Village',
            'Village - Edit Village',
            'Village - Pdf Village',
            'Village - Delete Village',

            // Transport Driver
            'Driver - All Driver',
            'Driver - Add New Driver',
            'Driver - View Driver',
            'Driver - Edit Driver',
            'Driver - Update Driver',
            'Driver - ChangeStatus Driver',
            'Driver - Delete Driver',
            'Driver - Pdf Driver',
            // End

            // Transport Driver
            'Location - All Location',
            'Location - Add New Location',
            'Location - View Location',
            'Location - Edit Location',
            'Location - Update Location',
            'Location - Delete Location',
            'Location - Pdf Location',
            // End

            // WeightUnit
            'WeightUnit - All WeightUnit',
            'WeightUnit - Add New WeightUnit',
            'WeightUnit - View WeightUnit',
            'WeightUnit - Edit WeightUnit',
            'WeightUnit - Update WeightUnit',
            'WeightUnit - Delete WeightUnit',
            'WeightUnit - Pdf WeightUnit',
            // End

            // Load
            'Load - All Load',
            'Load - Add New Load',
            'Load - View Load',
            'Load - Edit Load',
            'Load - Update Load',
            'Load - Delete Load',
            'Load - Pdf Load',
            // End

            // Dispatch
            'Dispatch - All Dispatch',
            'Dispatch - Add New Dispatch',
            'Dispatch - View Dispatch',
            'Dispatch - Edit Dispatch',
            'Dispatch - Update Dispatch',
            'Dispatch - Delete Dispatch',
            'Dispatch - Pdf Dispatch',
            // End


            // POD
            'POD - All POD',
            'POD - Add New POD',
            'POD - View POD',
            'POD - Edit POD',
            'POD - Update POD',
            'POD - Delete POD',
            // End

            // Expense
            'Expense - All Expense',
            'Expense - Add New Expense',
            'Expense - View Expense',
            'Expense - Edit Expense',
            'Expense - Update Expense',
            'Expense - Delete Expense',
            'Expense - Pdf Expense',
            // End

            // Expense
            'Truck Expense - All Truck Expense',
            'Truck Expense - Add New Truck Expense',
            'Truck Expense - View Truck Expense',
            'Truck Expense - Edit Truck Expense',
            'Truck Expense - Update Truck Expense',
            'Truck Expense - Delete Truck Expense',
            'Truck Expense - Pdf Truck Expense',
            // End

            // Finance
            'Finance - All Finance',
            'Finance - Add New Finance',
            'Finance - View Finance',
            'Finance - Edit Finance',
            'Finance - Update Finance',
            'Finance - Delete Finance',
            // End

            // Roles & Permission permissions
            // Role permission
            'Role - All Role',
            'Role - Add New Role',
            'Role - Edit Role',
            'Role - Delete Role',
            // Permision permission
            'Permission - All Permission',
            'Permission - Add New Permission',
            'Permission - Edit Permission',
            'Permission - Delete Permission'

        ];
        // Sync the super admin role with the necessary permissions
        $superAdminRole->syncPermissions($superAdminPermissions);
        // Assign the super admin role to each user
        foreach ($superAdminUsers as $superAdminuser) {
            $superAdminuser->assignRole($superAdminRole);
        }
        // super_admin end

        // Admin Role start
        $adminRole = Role::create(['name' => 'Admin']);
        $adminPermissions = [
            // Dashboard section Permission
            'Dashboard',

            // Employee permissions
            'Employee - All Employee',
            'Employee - Add New Employee',
            'Employee - View Employee',
            'Employee - Edit Employee',
            'Employee - Update Employee',

            // Company permissions
            'Company - All Company',
            'Company - Add New Company',
            'Company - View Company',
            'Company - Edit Company',
            'Company - Update Company',

            // Vehicles permissions
            'Truck - All Truck',
            'Truck - Add New Truck',
            'Truck - View Truck',
            'Truck - Edit Truck',
            'Truck - Update Truck',
            'Truck - Delete Truck',
            'Truck - Pdf All Truck',
            'Trailer - All Trailer',
            'Trailer - Add New Trailer',
            'Trailer - View Trailer',
            'Trailer - Edit Trailer',

            // Maintenance
            'Maintenance - Maintenance Log',
            'Maintenance - Inspections',

            // User permissions
            'User - All User',
            'User - Add New User',
            'User - View User',
            'User - Edit User',
            'User - Update User',
            'User - Store User',

            // User Profile permissions
            'UserProfile - View UserProfile',
            'UserProfile - Edit Name',
            'UserProfile - Edit Email',
            'UserProfile - Edit Password',

            // Country permissions
            'Country - All Country',
            'Country - Add New Country',
            'Country - View Country',
            'Country - Edit Country',
            'Country - Pdf Country',
            'Country - Delete Country',

            // Province permissions
            'Province - All Province',
            'Province - Add New Province',
            'Province - View Province',
            'Province - Edit Province',
            'Province - Pdf Province',
            'Province - Delete Province',

            // District permissions
            'District - All District',
            'District - Add New District',
            'District - View District',
            'District - Edit District',
            'District - Pdf District',
            'District - Delete District',

            // District permissions
            'Village - All Village',
            'Village - Add New Village',
            'Village - View Village',
            'Village - Edit Village',
            'Village - Pdf Village',
            'Village - Delete Village',

            // Transport Driver
            'Driver - All Driver',
            'Driver - Add New Driver',
            'Driver - View Driver',
            'Driver - Edit Driver',
            'Driver - Update Driver',
            'Driver - ChangeStatus Driver',

            // Transport Driver
            'Location - All Location',
            'Location - Add New Location',
            'Location - View Location',
            'Location - Edit Location',
            'Location - Update Location',
            'Location - Delete Location',

            // WeightUnit
            'WeightUnit - All WeightUnit',
            'WeightUnit - Add New WeightUnit',
            'WeightUnit - View WeightUnit',
            'WeightUnit - Edit WeightUnit',
            'WeightUnit - Update WeightUnit',
            // End

            // Load
            'Load - All Load',
            'Load - Add New Load',
            'Load - View Load',
            'Load - Edit Load',
            'Load - Update Load',
            // End

            // Dispatch
            'Dispatch - All Dispatch',
            'Dispatch - View Dispatch',
            'Dispatch - Edit Dispatch',
            'Dispatch - Update Dispatch',
            // End

            // Roles & Permission permissions
            // Role permission
            'Role - All Role',
            'Role - Add New Role',
            'Role - Edit Role',
            'Role - Delete Role',
            // Permision permission
            'Permission - All Permission',
            'Permission - Add New Permission',
            'Permission - Edit Permission',
            'Permission - Delete Permission'

        ];
        // Sync the super admin role with the necessary permissions
        $adminRole->syncPermissions($adminPermissions);
        // Admin end

        // Manager Role start
        $managerRole = Role::create(['name' => 'Manager']);
        $managerPermissions = [
            // Dashboard section Permission
            'Dashboard',

            // Employee permissions
            'Employee - All Employee',
            'Employee - Add New Employee',
            'Employee - View Employee',
            'Employee - Edit Employee',
            'Employee - Update Employee',

            // Company permissions
            'Company - All Company',
            'Company - Add New Company',
            'Company - View Company',
            'Company - Edit Company',
            'Company - Update Company',

            // Vehicles permissions
            'Truck - All Truck',
            'Truck - Add New Truck',
            'Truck - View Truck',
            'Truck - Edit Truck',
            'Truck - Update Truck',
            'Truck - Delete Truck',
            'Truck - Pdf All Truck',
            'Trailer - All Trailer',
            'Trailer - Add New Trailer',
            'Trailer - View Trailer',
            'Trailer - Edit Trailer',

            // Maintenance
            'Maintenance - Maintenance Log',
            'Maintenance - Inspections',

            // User permissions
            'User - All User',
            'User - Add New User',
            'User - View User',
            'User - Edit User',
            'User - Update User',
            'User - Store User',

            // User Profile permissions
            'UserProfile - View UserProfile',
            'UserProfile - Edit Name',
            'UserProfile - Edit Email',
            'UserProfile - Edit Password',

            // Country permissions
            'Country - All Country',
            'Country - Add New Country',
            'Country - View Country',
            'Country - Edit Country',
            'Country - Pdf Country',
            'Country - Delete Country',

            // Province permissions
            'Province - All Province',
            'Province - Add New Province',
            'Province - View Province',
            'Province - Edit Province',
            'Province - Pdf Province',
            'Province - Delete Province',

            // District permissions
            'District - All District',
            'District - Add New District',
            'District - View District',
            'District - Edit District',
            'District - Pdf District',
            'District - Delete District',

            // District permissions
            'Village - All Village',
            'Village - Add New Village',
            'Village - View Village',
            'Village - Edit Village',
            'Village - Pdf Village',
            'Village - Delete Village',

            // Transport Driver
            'Driver - All Driver',
            'Driver - Add New Driver',
            'Driver - View Driver',
            'Driver - Edit Driver',
            'Driver - Update Driver',
            'Driver - ChangeStatus Driver',

            // Transport Driver
            'Location - All Location',
            'Location - Add New Location',
            'Location - View Location',
            'Location - Edit Location',
            'Location - Update Location',
            'Location - Delete Location',

            // WeightUnit
            'WeightUnit - All WeightUnit',
            'WeightUnit - Add New WeightUnit',
            'WeightUnit - View WeightUnit',
            'WeightUnit - Edit WeightUnit',
            'WeightUnit - Update WeightUnit',
            // End

            // Load
            'Load - All Load',
            'Load - Add New Load',
            'Load - View Load',
            'Load - Edit Load',
            'Load - Update Load',
            // End

            // Dispatch
            'Dispatch - All Dispatch',
            'Dispatch - View Dispatch',
            'Dispatch - Edit Dispatch',
            'Dispatch - Update Dispatch',
            // End

            // Roles & Permission permissions
            // Role permission
            'Role - All Role',
            'Role - Add New Role',
            'Role - Edit Role',
            'Role - Delete Role',
            // Permision permission
            'Permission - All Permission',
            'Permission - Add New Permission',
            'Permission - Edit Permission',
            'Permission - Delete Permission'

        ];
        // Sync the super manager role with the necessary permissions
        $managerRole->syncPermissions($managerPermissions);
        // Manager end

        // Finance Role start
        $financeRole = Role::create(['name' => 'Finance']);
        $financePermissions = [
            // Dashboard section Permission
            'Dashboard',

            // Employee permissions
            'Employee - All Employee',
            'Employee - Add New Employee',
            'Employee - View Employee',
            'Employee - Edit Employee',
            'Employee - Update Employee',

            // Company permissions
            'Company - All Company',
            'Company - Add New Company',
            'Company - View Company',
            'Company - Edit Company',
            'Company - Update Company',

            // Vehicles permissions
            'Truck - All Truck',
            'Truck - Add New Truck',
            'Truck - View Truck',
            'Truck - Edit Truck',
            'Truck - Update Truck',
            'Truck - Delete Truck',
            'Truck - Pdf All Truck',
            'Trailer - All Trailer',
            'Trailer - Add New Trailer',
            'Trailer - View Trailer',
            'Trailer - Edit Trailer',

            // Maintenance
            'Maintenance - Maintenance Log',
            'Maintenance - Inspections',

            // User permissions
            'User - All User',
            'User - Add New User',
            'User - View User',
            'User - Edit User',
            'User - Update User',
            'User - Store User',

            // User Profile permissions
            'UserProfile - View UserProfile',
            'UserProfile - Edit Name',
            'UserProfile - Edit Email',
            'UserProfile - Edit Password',

            // Country permissions
            'Country - All Country',
            'Country - Add New Country',
            'Country - View Country',
            'Country - Edit Country',
            'Country - Pdf Country',
            'Country - Delete Country',

            // Province permissions
            'Province - All Province',
            'Province - Add New Province',
            'Province - View Province',
            'Province - Edit Province',
            'Province - Pdf Province',
            'Province - Delete Province',

            // District permissions
            'District - All District',
            'District - Add New District',
            'District - View District',
            'District - Edit District',
            'District - Pdf District',
            'District - Delete District',

            // District permissions
            'Village - All Village',
            'Village - Add New Village',
            'Village - View Village',
            'Village - Edit Village',
            'Village - Pdf Village',
            'Village - Delete Village',

            // Transport Driver
            'Driver - All Driver',
            'Driver - Add New Driver',
            'Driver - View Driver',
            'Driver - Edit Driver',
            'Driver - Update Driver',
            'Driver - ChangeStatus Driver',

            // Transport Driver
            'Location - All Location',
            'Location - Add New Location',
            'Location - View Location',
            'Location - Edit Location',
            'Location - Update Location',
            'Location - Delete Location',

            // WeightUnit
            'WeightUnit - All WeightUnit',
            'WeightUnit - Add New WeightUnit',
            'WeightUnit - View WeightUnit',
            'WeightUnit - Edit WeightUnit',
            'WeightUnit - Update WeightUnit',
            // End

            // Load
            'Load - All Load',
            'Load - Add New Load',
            'Load - View Load',
            'Load - Edit Load',
            'Load - Update Load',
            // End

            // Dispatch
            'Dispatch - All Dispatch',
            'Dispatch - View Dispatch',
            'Dispatch - Edit Dispatch',
            'Dispatch - Update Dispatch',
            // End

            // Roles & Permission permissions
            // Role permission
            'Role - All Role',
            'Role - Add New Role',
            'Role - Edit Role',
            'Role - Delete Role',
            // Permision permission
            'Permission - All Permission',
            'Permission - Add New Permission',
            'Permission - Edit Permission',
            'Permission - Delete Permission'

        ];
        // Sync the super finance role with the necessary permissions
        $financeRole->syncPermissions($financePermissions);
        // Finance end

        // Dispatcher Role start
        $dispatcherRole = Role::create(['name' => 'Dispatcher']);
        $dispatcherPermissions = [
            // Dashboard section Permission
            'Dashboard',

            // Employee permissions
            'Employee - All Employee',
            'Employee - Add New Employee',
            'Employee - View Employee',
            'Employee - Edit Employee',
            'Employee - Update Employee',

            // Company permissions
            'Company - All Company',
            'Company - Add New Company',
            'Company - View Company',
            'Company - Edit Company',
            'Company - Update Company',

            // Vehicles permissions
            'Truck - All Truck',
            'Truck - Add New Truck',
            'Truck - View Truck',
            'Truck - Edit Truck',
            'Truck - Update Truck',
            'Truck - Delete Truck',
            'Truck - Pdf All Truck',
            'Trailer - All Trailer',
            'Trailer - Add New Trailer',
            'Trailer - View Trailer',
            'Trailer - Edit Trailer',

            // Maintenance
            'Maintenance - Maintenance Log',
            'Maintenance - Inspections',

            // User permissions
            'User - All User',
            'User - Add New User',
            'User - View User',
            'User - Edit User',
            'User - Update User',
            'User - Store User',

            // User Profile permissions
            'UserProfile - View UserProfile',
            'UserProfile - Edit Name',
            'UserProfile - Edit Email',
            'UserProfile - Edit Password',

            // Country permissions
            'Country - All Country',
            'Country - Add New Country',
            'Country - View Country',
            'Country - Edit Country',
            'Country - Pdf Country',
            'Country - Delete Country',

            // Province permissions
            'Province - All Province',
            'Province - Add New Province',
            'Province - View Province',
            'Province - Edit Province',
            'Province - Pdf Province',
            'Province - Delete Province',

            // District permissions
            'District - All District',
            'District - Add New District',
            'District - View District',
            'District - Edit District',
            'District - Pdf District',
            'District - Delete District',

            // District permissions
            'Village - All Village',
            'Village - Add New Village',
            'Village - View Village',
            'Village - Edit Village',
            'Village - Pdf Village',
            'Village - Delete Village',

            // Transport Driver
            'Driver - All Driver',
            'Driver - Add New Driver',
            'Driver - View Driver',
            'Driver - Edit Driver',
            'Driver - Update Driver',
            'Driver - ChangeStatus Driver',

            // Transport Driver
            'Location - All Location',
            'Location - Add New Location',
            'Location - View Location',
            'Location - Edit Location',
            'Location - Update Location',
            'Location - Delete Location',

            // WeightUnit
            'WeightUnit - All WeightUnit',
            'WeightUnit - Add New WeightUnit',
            'WeightUnit - View WeightUnit',
            'WeightUnit - Edit WeightUnit',
            'WeightUnit - Update WeightUnit',
            // End

            // Load
            'Load - All Load',
            'Load - Add New Load',
            'Load - View Load',
            'Load - Edit Load',
            'Load - Update Load',
            // End

            // Dispatch
            'Dispatch - All Dispatch',
            'Dispatch - View Dispatch',
            'Dispatch - Edit Dispatch',
            'Dispatch - Update Dispatch',
            // End

        ];
        // Sync the super dispatcher role with the necessary permissions
        $dispatcherRole->syncPermissions($dispatcherPermissions);
        // Dispatcher end

        // Driver Role start
        $driverRole = Role::create(['name' => 'Driver']);
        $driverPermissions = [
            // Dashboard section Permission
            'Dashboard',

            // Employee permissions
            'Employee - All Employee',
            'Employee - Add New Employee',
            'Employee - View Employee',
            'Employee - Edit Employee',
            'Employee - Update Employee',
            'Employee - EnableDisable Employee',
            'Employee - Delete Employee',
            'Employee - Pdf All Employee',

            // Company permissions
            'Company - All Company',
            'Company - Add New Company',
            'Company - View Company',
            'Company - Edit Company',
            'Company - Update Company',
            'Company - Delete Company',
            'Company - Pdf All Company',

            // Vehicles permissions
            'Truck - All Truck',
            'Truck - Add New Truck',
            'Truck - View Truck',
            'Truck - Edit Truck',
            'Truck - Update Truck',
            'Truck - Delete Truck',
            'Truck - Pdf All Truck',
            'Trailer - All Trailer',
            'Trailer - Add New Trailer',
            'Trailer - View Trailer',
            'Trailer - Edit Trailer',
            'Trailer - Update Trailer',
            'Trailer - Delete Trailer',
            'Trailer - Pdf All Trailer',

            // Maintenance
            'Maintenance - Maintenance Log',
            'Maintenance - Inspections',

            // User permissions
            'User - All User',
            'User - Add New User',
            'User - View User',
            'User - Edit User',
            'User - Update User',
            'User - Store User',
            'User - Delete User',
            'User - ChangeStatus User',
            'User - StoreRole User',
            'User - RemoveRole User',
            'User - Pdf All User',

            // User Profile permissions
            'UserProfile - View UserProfile',
            'UserProfile - Edit Name',
            'UserProfile - Edit Email',
            'UserProfile - Edit Password',

            // Country permissions
            'Country - All Country',
            'Country - Add New Country',
            'Country - View Country',
            'Country - Edit Country',
            'Country - Pdf Country',
            'Country - Delete Country',

            // Province permissions
            'Province - All Province',
            'Province - Add New Province',
            'Province - View Province',
            'Province - Edit Province',
            'Province - Pdf Province',
            'Province - Delete Province',

            // District permissions
            'District - All District',
            'District - Add New District',
            'District - View District',
            'District - Edit District',
            'District - Pdf District',
            'District - Delete District',

            // District permissions
            'Village - All Village',
            'Village - Add New Village',
            'Village - View Village',
            'Village - Edit Village',
            'Village - Pdf Village',
            'Village - Delete Village',

            // Transport Driver
            'Driver - All Driver',
            'Driver - Add New Driver',
            'Driver - View Driver',
            'Driver - Edit Driver',
            'Driver - Update Driver',
            'Driver - ChangeStatus Driver',
            'Driver - Delete Driver',
            'Driver - Pdf Driver',
            // End

            // Transport Driver
            'Location - All Location',
            'Location - Add New Location',
            'Location - View Location',
            'Location - Edit Location',
            'Location - Update Location',
            'Location - Delete Location',
            'Location - Pdf Location',
            // End

            // WeightUnit
            'WeightUnit - All WeightUnit',
            'WeightUnit - Add New WeightUnit',
            'WeightUnit - View WeightUnit',
            'WeightUnit - Edit WeightUnit',
            'WeightUnit - Update WeightUnit',
            'WeightUnit - Delete WeightUnit',
            'WeightUnit - Pdf WeightUnit',
            // End

            // Load
            'Load - All Load',
            'Load - Add New Load',
            'Load - View Load',
            'Load - Edit Load',
            'Load - Update Load',
            'Load - Delete Load',
            'Load - Pdf Load',
            // End

            // Dispatch
            'Dispatch - All Dispatch',
            'Dispatch - View Dispatch',
            'Dispatch - Edit Dispatch',
            'Dispatch - Update Dispatch',
            'Dispatch - Delete Dispatch',
            'Dispatch - Pdf Dispatch',
            // End

            // Roles & Permission permissions
            // Role permission
            'Role - All Role',
            'Role - Add New Role',
            'Role - Edit Role',
            'Role - Delete Role',
            // Permision permission
            'Permission - All Permission',
            'Permission - Add New Permission',
            'Permission - Edit Permission',
            'Permission - Delete Permission'

        ];
        // Sync the super admin role with the necessary permissions
        $driverRole->syncPermissions($driverPermissions);
        // Driver end

        // Staff Role start
        $staffRole = Role::create(['name' => 'Staff']);
        $staffPermissions = [
            // Dashboard section Permission
            'Dashboard',

            // Employee permissions
            'Employee - All Employee',
            'Employee - Add New Employee',
            'Employee - View Employee',
            'Employee - Edit Employee',
            'Employee - Update Employee',

        ];
        // Sync the super staff role with the necessary permissions
        $staffRole->syncPermissions($staffPermissions);
        // Staff end
    }
}
