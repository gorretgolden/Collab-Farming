import AdminDashboard from '../component/Dashboards/adminDashboard';
import EmailLogs from '../component/admin/logs/logs';
import Users from '../component/admin/users/index';
import centers from '../component/admin/settings/centers';
import inputs from '../component/admin/settings/inputs';
import price from '../component/admin/settings/price';

const AdminRoutes = [
  //admin routes
  {
    path: '/fanmis-admin',
    component: AdminDashboard,
    name: 'dashboard-admin',
    for: 'admin',
  },

  {
    path: '/email-logs',
    component: EmailLogs,
    name: 'logs-admin',
    for: 'admin',
  },
  {
    path: '/users-management',
    component: Users,
    name: 'users-admin-manager',
    for: 'admin',
  },





  //Admin routes of Arnold

  //bulking-centers
  {
    path: '/centers',
    component: centers,
    name: 'centers',
    for: 'admin',
  },
  //inputs
  {
    path: '/farmer-inputs',
    component: inputs,
    name: 'inputs-display',
    for: 'admin',
  },

  //price
  {
    path: '/newprices',
    component: price,
    name: 'egg-prices',
    for: 'admin',
  },
];

export default AdminRoutes;
