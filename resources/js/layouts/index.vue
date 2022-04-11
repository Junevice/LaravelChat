<template>
    <div class="w-full bg-background main flex justify-center items-center">
        <slot/>
    </div>
</template>

<style scoped>
    .main{
        height: calc(auto - 64px);
        background-image: url('/images/background.svg');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: bottom;
    }
</style>