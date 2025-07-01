@extends('layouts.app')

@section('content')
    <div id="background" class="relative w-full">
        <div class="absolute w-full h-[356px] bg-[linear-gradient(0deg,#4EB6F5_0%,#5B8CE9_100%)] -z-10"></div>
    </div>
    <section id="Header" class="w-full max-w-[1280px] mx-auto px-[52px] my-16">
        <div class="flex flex-col gap-16">
            <div class="flex flex-col items-center gap-1">
                <p class="font-bold text-[32px] leading-[48px] capitalize text-white">View Your Booking</p>
                <p class="text-white">Enter the booking code sent to your email to check the status of your booking.</p>
            </div>
            <main class="flex gap-8">
                <form action="e-ticket.html" class="flex items-center justify-between w-full rounded-full p-3 pl-8 gap-6 bg-white overflow-hidden">
                    <label class="flex items-center gap-2 w-full">
                        <img src="assets/images/icons/receipt-black.svg" class="w-8 h-8 flex shrink-0" alt="icon">
                        <input type="text" name="bookingid" id="bookingid" class="appearance-none outline-none font-semibold text-lg leading-[27px] placeholder:text-aktiv-black" placeholder="Booking ID">
                    </label>
                    <div class="h-12 border-[1.5px] border-[#E6E7EB]"></div>
                    <label class="flex items-center gap-2 w-full">
                        <img src="assets/images/icons/call-black.svg" class="w-8 h-8 flex shrink-0" alt="icon">
                        <input type="tel" name="phone" id="phone" class="appearance-none outline-none font-semibold text-lg leading-[27px] placeholder:text-aktiv-black" placeholder="Phone No">
                    </label>
                    <button type="submit" class="flex items-center shrink-0 gap-2 rounded-full py-4 px-8 bg-aktiv-orange">
                        <img src="assets/images/icons/search-normal.svg" class="w-8 h-8 flex shrink-0" alt="icon">
                        <span class="font-semibold text-lg leading-[27px] text-white text-nowrap">View My Booking</span>
                    </button>
                </form>
            </main>
        </div>
    </section>
    <section id="Benefits" class="py-[100px] bg-white mb-8">
        <div class="flex flex-col gap-8 w-full max-w-[1280px] px-[52px] mx-auto">
            <div class="flex items-center justify-center">
                <h2 class="font-Neue-Plak-bold text-[32px] leading-[44.54px] capitalize text-center">Get acquainted with us! 🙌🏻</h2>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="flex flex-col h-full justify-between rounded-3xl border border-[#E6E7EB] p-6 gap-3 bg-white">
                    <div class="flex items-center gap-3">
                        <img src="assets/images/icons/In-Depth Learning from Experts Instructor.png" class="flex w-[56px] h-[56px] shrink-0" alt="icon">
                        <h3 class="font-semibold text-lg leading-[27px]">In-Depth Learning from Experts Instructor</h3>
                    </div>
                    <p class="font-medium leading-[25.6px] text-aktiv-grey">We feature instructors with strong field-specific expertise.</p>
                </div>
                <div class="flex flex-col h-full justify-between rounded-3xl border border-[#E6E7EB] p-6 gap-3 bg-white">
                    <div class="flex items-center gap-3">
                        <img src="assets/images/icons/Tangible Results.png" class="flex w-[56px] h-[56px] shrink-0" alt="icon">
                        <h3 class="font-semibold text-lg leading-[27px]">Tangible Results</h3>
                    </div>
                    <p class="font-medium leading-[25.6px] text-aktiv-grey">Our students are highly engaged and supportive of our community.</p>
                </div>
                <div class="flex flex-col h-full justify-between rounded-3xl border border-[#E6E7EB] p-6 gap-3 bg-white">
                    <div class="flex items-center gap-3">
                        <img src="assets/images/icons/Supportive Learning Environment.png" class="flex w-[56px] h-[56px] shrink-0" alt="icon">
                        <h3 class="font-semibold text-lg leading-[27px]">Supportive Learning Environment</h3>
                    </div>
                    <p class="font-medium leading-[25.6px] text-aktiv-grey">We feature instructors with strong field-specific expertise.</p>
                </div>
                <div class="flex flex-col h-full justify-between rounded-3xl border border-[#E6E7EB] p-6 gap-3 bg-white">
                    <div class="flex items-center gap-3">
                        <img src="assets/images/icons/community support.png" class="flex w-[56px] h-[56px] shrink-0" alt="icon">
                        <h3 class="font-semibold text-lg leading-[27px]">Community Support</h3>
                    </div>
                    <p class="font-medium leading-[25.6px] text-aktiv-grey">We feature instructors with strong field-specific expertise.</p>
                </div>
                <div class="flex flex-col h-full justify-between rounded-3xl border border-[#E6E7EB] p-6 gap-3 bg-white">
                    <div class="flex items-center gap-3">
                        <img src="assets/images/icons/Networking Opportunities With Other.png" class="flex w-[56px] h-[56px] shrink-0" alt="icon">
                        <h3 class="font-semibold text-lg leading-[27px]">Networking Opportunities With Other</h3>
                    </div>
                    <p class="font-medium leading-[25.6px] text-aktiv-grey">We feature instructors with strong field-specific expertise.</p>
                </div>
                <div class="flex flex-col h-full justify-between rounded-3xl border border-[#E6E7EB] p-6 gap-3 bg-white">
                    <div class="flex items-center gap-3">
                        <img src="assets/images/icons/Learning Flexibility.png" class="flex w-[56px] h-[56px] shrink-0" alt="icon">
                        <h3 class="font-semibold text-lg leading-[27px]">Learning Flexibility</h3>
                    </div>
                    <p class="font-medium leading-[25.6px] text-aktiv-grey">We offer a variety of workshops that you can learn from every day.</p>
                </div>
            </div>
            <a href="#" class="flex items-center rounded-full py-4 px-6 h-[56px] gap-3 bg-aktiv-orange mx-auto">
                <span class="font-semibold text-white">Learn More</span>
                <span class="w-6 h-6 rounded-full bg-white text-center align-middle text-aktiv-orange font-bold">></span>
            </a>
        </div>
    </section>
@endsection