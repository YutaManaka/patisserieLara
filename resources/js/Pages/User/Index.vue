<template>
    <ul>
        <li
            v-for="user in users"
            v-text="user.name">
        </li>
    </ul>
</template>

<script>
export default {
    props: {
        users: Object,
    },
}
</script>