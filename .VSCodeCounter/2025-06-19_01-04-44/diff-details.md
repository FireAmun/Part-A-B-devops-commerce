# Diff Details

Date : 2025-06-19 01:04:44

Directory c:\\laragon\\www\\commerce-app

Total : 51 files,  6680 codes, 103 comments, 896 blanks, all 7679 lines

[Summary](results.md) / [Details](details.md) / [Diff Summary](diff.md) / Diff Details

## Files
| filename | language | code | comment | blank | total |
| :--- | :--- | ---: | ---: | ---: | ---: |
| [app/Http/Controllers/AdminController.php](/app/Http/Controllers/AdminController.php) | PHP | 293 | 22 | 62 | 377 |
| [app/Http/Controllers/AdminLoginController.php](/app/Http/Controllers/AdminLoginController.php) | PHP | 24 | 5 | 7 | 36 |
| [app/Http/Controllers/ChatbotController.php](/app/Http/Controllers/ChatbotController.php) | PHP | 468 | 13 | 79 | 560 |
| [app/Http/Controllers/OrderController.php](/app/Http/Controllers/OrderController.php) | PHP | -3 | 1 | 0 | -2 |
| [app/Http/Controllers/VendorController.php](/app/Http/Controllers/VendorController.php) | PHP | 327 | 9 | 76 | 412 |
| [app/Http/Controllers/VendorDashboardController.php](/app/Http/Controllers/VendorDashboardController.php) | PHP | 4 | 6 | 4 | 14 |
| [app/Http/Controllers/VendorLoginController.php](/app/Http/Controllers/VendorLoginController.php) | PHP | 19 | 3 | 5 | 27 |
| [app/Http/Controllers/VendorPasswordController.php](/app/Http/Controllers/VendorPasswordController.php) | PHP | 93 | 8 | 30 | 131 |
| [app/Http/Kernel.php](/app/Http/Kernel.php) | PHP | -2 | -8 | -1 | -11 |
| [app/Http/Middleware/AdminMiddleware.php](/app/Http/Middleware/AdminMiddleware.php) | PHP | 25 | 4 | 9 | 38 |
| [app/Http/Middleware/VendorMiddleware.php](/app/Http/Middleware/VendorMiddleware.php) | PHP | 8 | 1 | 3 | 12 |
| [app/Models/Admin.php](/app/Models/Admin.php) | PHP | 5 | 0 | 1 | 6 |
| [app/Models/Complaint.php](/app/Models/Complaint.php) | PHP | 3 | 0 | 1 | 4 |
| [app/Models/Otp.php](/app/Models/Otp.php) | PHP | 16 | 0 | 6 | 22 |
| [app/Models/Product.php](/app/Models/Product.php) | PHP | 10 | 1 | 3 | 14 |
| [database/migrations/2023\_04\_28\_create\_admins\_table.php](/database/migrations/2023_04_28_create_admins_table.php) | PHP | 20 | 0 | 4 | 24 |
| [database/migrations/2024\_01\_01\_000000\_add\_role\_to\_admins\_table.php](/database/migrations/2024_01_01_000000_add_role_to_admins_table.php) | PHP | 19 | 0 | 4 | 23 |
| [database/migrations/2024\_01\_15\_000000\_add\_name\_to\_admins\_table.php](/database/migrations/2024_01_15_000000_add_name_to_admins_table.php) | PHP | 23 | 1 | 4 | 28 |
| [database/migrations/2024\_01\_15\_000000\_add\_role\_to\_admins\_table.php](/database/migrations/2024_01_15_000000_add_role_to_admins_table.php) | PHP | 23 | 1 | 4 | 28 |
| [database/migrations/2025\_06\_15\_062052\_create\_complaints\_table.php](/database/migrations/2025_06_15_062052_create_complaints_table.php) | PHP | -18 | -6 | -4 | -28 |
| [database/seeders/AdminSeeder.php](/database/seeders/AdminSeeder.php) | PHP | 27 | 2 | 5 | 34 |
| [resources/views/admin/admins/create.blade.php](/resources/views/admin/admins/create.blade.php) | PHP | 196 | 1 | 12 | 209 |
| [resources/views/admin/admins/edit.blade.php](/resources/views/admin/admins/edit.blade.php) | PHP | 204 | 1 | 13 | 218 |
| [resources/views/admin/admins/index.blade.php](/resources/views/admin/admins/index.blade.php) | PHP | 264 | 1 | 17 | 282 |
| [resources/views/admin/analytics.blade.php](/resources/views/admin/analytics.blade.php) | PHP | 317 | 3 | 26 | 346 |
| [resources/views/admin/dashboard.blade.php](/resources/views/admin/dashboard.blade.php) | PHP | 449 | 1 | 56 | 506 |
| [resources/views/admin/products/edit.blade.php](/resources/views/admin/products/edit.blade.php) | PHP | 442 | 2 | 54 | 498 |
| [resources/views/admin/products/index.blade.php](/resources/views/admin/products/index.blade.php) | PHP | 457 | 8 | 39 | 504 |
| [resources/views/admin/users/create.blade.php](/resources/views/admin/users/create.blade.php) | PHP | 180 | 1 | 11 | 192 |
| [resources/views/admin/users/edit.blade.php](/resources/views/admin/users/edit.blade.php) | PHP | 279 | 0 | 30 | 309 |
| [resources/views/admin/users/index.blade.php](/resources/views/admin/users/index.blade.php) | PHP | 299 | 1 | 34 | 334 |
| [resources/views/admin/vendors/index.blade.php](/resources/views/admin/vendors/index.blade.php) | PHP | 418 | 1 | 49 | 468 |
| [resources/views/auth/admin-login.blade.php](/resources/views/auth/admin-login.blade.php) | PHP | -59 | -1 | -8 | -68 |
| [resources/views/auth/vendor-login-richiamo.blade.php](/resources/views/auth/vendor-login-richiamo.blade.php) | PHP | 17 | 2 | 2 | 21 |
| [resources/views/auth/vendor-login-setepak.blade.php](/resources/views/auth/vendor-login-setepak.blade.php) | PHP | 7 | 1 | 1 | 9 |
| [resources/views/auth/vendor-login-utm-mart.blade.php](/resources/views/auth/vendor-login-utm-mart.blade.php) | PHP | 7 | 1 | 1 | 9 |
| [resources/views/auth/vendor-select.blade.php](/resources/views/auth/vendor-select.blade.php) | PHP | 6 | 0 | 1 | 7 |
| [resources/views/components/chatbot.blade.php](/resources/views/components/chatbot.blade.php) | PHP | 893 | 26 | 144 | 1,063 |
| [resources/views/home.blade.php](/resources/views/home.blade.php) | PHP | 3 | 0 | 1 | 4 |
| [resources/views/orders.blade.php](/resources/views/orders.blade.php) | PHP | 6 | 0 | 0 | 6 |
| [resources/views/vendor2/dashboard-caffe.blade.php](/resources/views/vendor2/dashboard-caffe.blade.php) | PHP | 157 | 1 | 17 | 175 |
| [resources/views/vendor2/products/edit.blade.php](/resources/views/vendor2/products/edit.blade.php) | PHP | 144 | 0 | 21 | 165 |
| [resources/views/vendor2/products/index.blade.php](/resources/views/vendor2/products/index.blade.php) | PHP | -8 | 0 | 1 | -7 |
| [resources/views/vendor3/dashboard-setepak.blade.php](/resources/views/vendor3/dashboard-setepak.blade.php) | PHP | 157 | 1 | 17 | 175 |
| [resources/views/vendor3/products/create.blade.php](/resources/views/vendor3/products/create.blade.php) | PHP | 200 | 3 | 27 | 230 |
| [resources/views/vendor3/products/edit.blade.php](/resources/views/vendor3/products/edit.blade.php) | PHP | 144 | 0 | 21 | 165 |
| [resources/views/vendor3/products/index.blade.php](/resources/views/vendor3/products/index.blade.php) | PHP | 7 | 1 | 3 | 11 |
| [resources/views/vendor/dashboard-utm-mart.blade.php](/resources/views/vendor/dashboard-utm-mart.blade.php) | PHP | 168 | 1 | 18 | 187 |
| [resources/views/vendor/products/edit.blade.php](/resources/views/vendor/products/edit.blade.php) | PHP | -39 | 0 | -5 | -44 |
| [resources/views/vendor/products/index.blade.php](/resources/views/vendor/products/index.blade.php) | PHP | -8 | 0 | 1 | -7 |
| [routes/web.php](/routes/web.php) | PHP | -11 | -16 | -10 | -37 |

[Summary](results.md) / [Details](details.md) / [Diff Summary](diff.md) / Diff Details