<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification Page</title>
</head>
<script src="{{ asset('otp.js') }}"></script>
<script src="https://cdn.tailwindcss.com"></script>

<body>
    <div class="relative font-inter antialiased">

        <main class="relative min-h-screen flex flex-col justify-center bg-slate-50 overflow-hidden">
            <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
                <div class="flex justify-center">

                    <div class="max-w-md mx-auto text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
                        <header class="mb-8">
                            <h1 class="text-2xl font-bold mb-1">Email Verification</h1>
                            <p class="text-[15px] text-slate-500">Enter the 4-digit verification code that was sent to your Email id.</p>
                        </header>
                        <form action="" id="otp-form" method="post">
                            {{session('otp')}}
                            <br>
                            @csrf
                            <div class="flex items-center justify-center gap-3">
                                <input type="text" name="d1" class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" pattern="\d*" maxlength="1" oninput="moveToNextInput(this);" />
                                <input type="text" name="d2" class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" maxlength="1" oninput="moveToNextInput(this);" />
                                <input type="text" name="d3" class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" maxlength="1" oninput="moveToNextInput(this);" />
                                <input type="text" name="d4" class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" maxlength="1" oninput="moveToNextInput(this);" />
                            </div>
                            <div class="max-w-[260px] mx-auto mt-4">
                                <button name="verify" type="submit" class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-indigo-500 px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150">Verify
                                    Account</button><br><br>

                                <button name="resend" type="submit" class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-indigo-500 px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150">Resend OTP!</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>
    
</body>

</html>
