import AccountDashBoard from "../component/Dashboards/accountDashboard.vue";
import DeliveryRequests from "../component/accounts/DeliveryRequests.vue";
import PaymentOrders from "../component/accounts/PaymentOrders.vue";
import FeedRequests from "../component/accounts/FeedRequests.vue";

const AccountRoutes = [
    {
        path: "/account-dashboard",
        component: AccountDashBoard,
        name: "account-dashboard",
        for: "account",
    },

    {
        path: "/delivery-requests",
        component: DeliveryRequests,
        name: "delivery-requests",
        for: "account",
    },
    {
        path: "/feed-requests",
        component: FeedRequests,
        name: "feed-requests",
        for: "account",
    },

    {
        path: "/payment-orders",
        component: PaymentOrders,
        name: "payment-orders",
        for: "account",
    },
];

export default AccountRoutes;
