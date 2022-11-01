import FarmerDashboard from "../component/Dashboards/FarmerDashboard";
import FarmerReceipts from "../component/farmer/FarmerReceipts";

const FarmerRoutes = [
    {
        path: "/fanmis-farmer",
        component: FarmerDashboard,
        name: "farmer-dashboard",
        for: "farm",
    },

    {
        path: "/farmer-receipts",
        component: FarmerReceipts,
        name: "farmer-receipts",
        for: "farm",
    },
];

export default FarmerRoutes;
