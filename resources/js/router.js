import {createRouter, createWebHistory} from 'vue-router';

import Login from '../js/component/auth/login';
import AdminDashboard from './component/Dashboards/adminDashboard';
import AccountRoutes from './routes/accountRoutes';
import AdminRoutes from './routes/adminRoutes';
import AgentRoutes from './routes/agentRoute';
import EnumeratorRoutes from './routes/enumeratorRoutes';
import FarmerRoutes from './routes/farmerRoutes';
import routeGuard from './routes/routeGuard';
import PageNotFound from './component/404/pageNotFound';

//Vue.use(VueRouter)

var routes = [
  //Public routes  Ivan
  {
    path: '/login',
    component: Login,
    name: 'login',
  },

  {
    path: '/',
    component: AdminDashboard,
    name: 'dashboad',
  },

  //Enumerator routes
];

//add admin routes to array

routes = [...routes, ...AdminRoutes];

//Add enumerator routes to array

routes = [...routes, ...EnumeratorRoutes];

//Add farmer  routes to array

routes = [...routes, ...FarmerRoutes];

//Add Agent routes to array

routes = [...routes, ...AgentRoutes];

//Add account routes to array

routes = [...routes, ...AccountRoutes];

//include the 404 page
const not_found_page = {
  path: '/:pathMatch(.*)*',

  component: PageNotFound,
};

routes.push (not_found_page);

//IIconsole.log (routes);
//Add AccountRoutes

const router = createRouter ({
  history: createWebHistory (),
  routes,
  routes,
  linkActiveClass: 'active', // active class for non-exact links.
  linkExactActiveClass: 'active', // active class for *exact* links.
});

//Router Guard for the authenticated, admin and enumerator user type
router.beforeEach (async (to, from) => {
  //Route guard for different action performed by the user
  return routeGuard (to, from);
});

export default router;
