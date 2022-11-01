<template>
    <div class="d-flex" v-cloak>
        <SideNavigation />

        <div id="page-content-wrapper">
            <AccountHeader />

            <div class="content-padding">
                <nav
                    class="nav nav-tab"
                    style="height: 55px; margin-bottom: -1rem"
                    id="unicef-tabs-cit"
                >
                    <a
                        @click.prevent="changeTab(0)"
                        data-tab="0"
                        href="#"
                        style="color: #333; padding: 0.5rem 0 !important"
                        class="nav-item nav-link"
                        :class="{ active: tab === 0 }"
                        >Egg Delivery Requests</a
                    >

                    <a
                        @click.prevent="changeTab(1)"
                        data-tab="1"
                        href="#"
                        style="color: #333; padding: 0.5rem 2.5rem !important"
                        class="nav-item nav-link"
                        :class="{ active: tab === 1 }"
                        >Feed Requests</a
                    >
                </nav>

                <EggRequests type="eggs" v-if="tab == 0" />
                <FeedRequests type="feed" v-else />
            </div>
        </div>
    </div>
</template>

<script>
import SideNavigation from "../Layout/accountLayout/sideNavigation.vue";
import AccountHeader from "../Layout/accountLayout/header.vue";

import EggRequests from "./EggRequests.vue";
import FeedRequests from "./FeedRequests.vue"
export default {
    name: "DeliveryRequests",

    components: { SideNavigation, AccountHeader, EggRequests, FeedRequests },

    data() {
        return {
            tab: 0,
        };
    },

    methods: {
        changeTab(t) {
            this.tab = t;
        },
    },
};
</script>

<style></style>
