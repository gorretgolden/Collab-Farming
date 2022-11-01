<template>
    <nav
        class="navbar navbar-expand-lg border-bottom shadow-sm"
        style="background: white"
    >
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul
                class="navbar-nav ml-auto mt-2 mt-lg-0"
                style="position: absolute; right: 5%"
            >
                <li class="nav-item active">
                    <a class="nav-link username-link text-muted mt-1" href="#"
                        >Welcome {{ user.name }}</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="font-size: 22px"
                        ><i class="fa fa-bell" style="color: #999999"></i
                    ></a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        @click="openOrCloseMenu"
                        href="#"
                        style="font-size: 22px"
                        ><i class="fa fa-bars" style="color: #999999"></i
                    ></a>
                    <menu-list />
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import Request from "../../mixins/requestHelper";
import menuList from "./menuList.vue";
export default {
    name: "farmer-header",
    components: { menuList },

    data() {
        return {
            user: {},
        };
    },
    methods: {
        openOrCloseMenu() {
            $("#cp-nav-menu").toggle();
        },
    },

    mounted() {
        const app = this;

        app.user = Request.getUser();

        //console.log(Request.getUser().name)

        // app.getUser();
        // alert("Ok")
    },
};
</script>
