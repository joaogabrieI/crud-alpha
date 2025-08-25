<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Login</title>
</head>

<body class="h-full">
    <main>
        <section class="form-container login-container">
            <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company" class="mx-auto h-10 w-auto" />
                    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">Acesse a sua conta
                    </h2>
                </div>

                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form action="/admin/login" method="POST" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm/6 font-medium text-gray-100">Email</label>
                            <div class="mt-2">
                                <input id="email" type="text" name="email" autocomplete="email"
                                    class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm/6 font-medium text-gray-100">Senha</label>
                                <div class="text-sm">
                                    <a href="#" class="font-semibold text-indigo-400 hover:text-indigo-300">Esqueceu a
                                        senha?</a>
                                </div>
                            </div>
                            <div class="mt-2">
                                <input id="password" type="password" name="password" autocomplete="current-password"
                                    class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                Entrar</button>
                        </div>
                    </form>
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $message): ?>
                            <div class="flex items-center justify-center pt-5">
                                <div
                                    class="flex items-center gap-3 bg-red-500 text-white p-4 rounded-2xl shadow-lg w-full max-w-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 
               0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 
               0L4.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>

                                    <span class="text-base font-medium alert-<?= $msg['type'] ?>">
                                        <?= $message['text'] ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>