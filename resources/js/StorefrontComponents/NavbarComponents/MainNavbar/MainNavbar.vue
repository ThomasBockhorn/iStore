<template>
    <nav class="flex items-center justify-between bg-white flex-wrap p-6">
        <div class="flex items-center flex-no-shrink text-black mr-6">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <g
                    style="
                        fill: none;
                        fill-rule: evenodd;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                        stroke: #222f3e;
                        stroke-width: 4;
                    "
                >
                    <path
                        d="m95.063447 8.94270835v77.83656635l-34.8923203-.0000013c-5.8516608 0-10.5953691 4.736511-10.5953691 10.6042152v-6.653102-1.4514316c0-5.3691378 4.3406454-9.7031974 9.6951029-9.7031974h29.0927759v-70.63304926z"
                    />
                    <path
                        d="m49.5757576 11.6938381c0-5.34418156 4.3373597-9.6938381 9.6877641-9.6938381h29.1001147v77.5757576h-29.0927759c-5.3544575 0-9.6951029 4.3340596-9.6951029 9.7031974v1.4514316z"
                    />
                    <path
                        d="m4.08806818 8.94270835v77.83656635l34.89232032-.0000013c5.8516608 0 10.5953691 4.736511 10.5953691 10.6042152v-6.653102-1.4514316c0-5.3691378-4.3406455-9.7031974-9.695103-9.7031974h-29.0927758v-70.63304926z"
                    />
                    <path
                        d="m49.5757576 11.6938381c0-5.34418156-4.3373598-9.6938381-9.6877642-9.6938381h-29.1001146v77.5757576h29.0927758c5.3544575 0 9.695103 4.3340596 9.695103 9.7031974v1.4514316z"
                    />
                </g>
            </svg>
            <span class="font-semibold text-xl trackting-tight"
                >Shakespeare's Books</span
            >
        </div>
        <div class="block sm:hidden">
            <button
                @click="toggle"
                class="flex items-center h-10 w-10 text-black border-black hover:text-grey"
            >
                <svg
                    class="fill-current h-full w-full"
                    enable-background="new 0 0 32 32"
                    viewBox="0 0 32 32"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <title>Menu</title>
                    <g
                        style="
                            fill: none;
                            stroke: #000;
                            stroke-width: 2;
                            stroke-linecap: round;
                            stroke-linejoin: round;
                            stroke-miterlimit: 10;
                        "
                    >
                        <path
                            d="m24 28h-16c-2.2 0-4-1.8-4-4v-16c0-2.2 1.8-4 4-4h16c2.2 0 4 1.8 4 4v16c0 2.2-1.8 4-4 4z"
                        />
                        <path d="m10 16h12" />
                        <path d="m10 12h12" />
                        <path d="m10 20h12" />
                    </g>
                </svg>
            </button>
        </div>
        <div
            :class="open ? 'block' : 'hidden'"
            class="w-full flex-grow sm:flex sm:items-center sm:w-auto"
        >
            <div class="tex-sm sm:flex-grow">
                <a
                    href="#responsive-header"
                    class="no-underline block mt-4 sm:inline-block sm:mt-0 text-black hover:text-grey mr-4"
                    >Link 1</a
                >
                <a
                    href="#responsive-header"
                    class="no-underline block mt-4 sm:inline-block sm:mt-0 text-black hover:text-grey mr-4"
                    >Link 2</a
                >
                <a
                    href="#responsive-header"
                    class="no-underline block mt-4 sm:inline-block sm:mt-0 text-black hover:text-grey mr-4"
                    >Link 3</a
                >
            </div>
            <div>
                <a
                    href="#"
                    class="no-underline inline-block text-sm px-4 py-2 leading-none border rounded text-black border-black hover:border-blue hover:text-blue hover:bg-white mt-4 sm:mt-0"
                    >Contact Us</a
                >
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data: () => {
        return {
            open: false,
        };
    },
    methods: {
        toggle() {
            this.open = !this.open;
        },
    },
};
</script>

<style></style>
