<div
    class="flex flex-col w-full p-10 mx-auto my-6 transition duration-500 ease-in-out transform bg-white border rounded-lg lg:w-1/4 md:w-1/2 md:mt-0">

    <div class="relative  mt-4">
        <label for="email" class="text-base leading-7 text-blueGray-500">Email</label>
        <input wire:model="email" type="name" id="email" name="email" placeholder="email"
            class="@error('email') border-red-300 @enderror w-full px-4 py-2 mt-2 text-base text-black transition duration-500 ease-in-out transform border border-gray-200 rounded-lg bg-blueGray-100 focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
        @error('email')
            <div class="text-red-300 text-sm mt-1">
                {{ $message}}
            </div>
        @enderror
    </div>

    <div class="relative mt-4">
        <label for="password" class="text-base leading-7 text-blueGray-500">Password</label>
        <input wire:model.lazy="password" type="password" id="password" name="password" placeholder="password"
            class="@error('password') border-red-300 @enderror w-full px-4 py-2 mt-2 text-base text-black transition duration-500 ease-in-out transform border border-gray-20 rounded-lg bg-blueGray-100 focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2">
        @error('password')
            <div class="text-red-300 text-sm mt-1">
                {{ $message}}
            </div>
        @enderror
    </div>

    <div class="inline-flex flex-wrap items-center justify-between mt-3">

        <button
        wire:click="login"
            class="w-full px-4 py-2 my-2 text-base font-medium text-white transition duration-500 ease-in-out transform bg-blue-600 border-blue-600 rounded-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-blue-800">
            Register </button>

    </div>

    <div class="mt-6">
        <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
            <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                Haven't signed up yet?
            </a>
        </p>
    </div>

</div>

