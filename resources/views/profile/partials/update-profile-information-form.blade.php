<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 p-6">

    <section class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update your account's profile information and email address.
            </p>
        </header>

        <form id="send-verification" method="post" action="#">
            <!-- @csrf -->
        </form>

        <form method="post" action="#" class="mt-6 space-y-6">
            <!-- @csrf -->
            <!-- @method('patch') -->

            <div>
                <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300 block">Name</label>
                <input id="name" name="name" type="text" required autofocus autocomplete="name"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                <p class="mt-2 text-sm text-red-600 dark:text-red-400"> <!-- Error message --></p>
            </div>

            <div>
                <label for="email" class="text-sm font-medium text-gray-700 dark:text-gray-300 block">Email</label>
                <input id="email" name="email" type="email" required autocomplete="username"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                <p class="mt-2 text-sm text-red-600 dark:text-red-400"> <!-- Error message --></p>

                <!-- Verifikasi email -->
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        Your email address is unverified.

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    <!-- Kondisi: session status -->
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        A new verification link has been sent to your email address.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Save
                </button>

                <p class="text-sm text-gray-600 dark:text-gray-400 transition-opacity duration-1000">
                    Saved.
                </p>
            </div>
        </form>
    </section>

</body>
</html>
