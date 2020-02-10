<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-bell"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <div v-for="notification in notifications">
                <a :href="notification.data.link"
                    class="dropdown-item"
                    v-text="notification.data.message"
                    @click="markAsRead(notification)"
                ></a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return { notifications: false }
        },

        created() {
            axios.get("/profiles/" + window.App.user.name + "/notifications/")
                .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }
    };
</script>
