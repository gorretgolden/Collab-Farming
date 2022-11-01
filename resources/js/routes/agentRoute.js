import AgentDashBoard from '../component/Dashboards/agentDashboard';
import weightsManagement from '../component/collections/weightsManagement';
import deliveryWeights from '../component/collections/deliveryWeights';
import feedRequests from '../component/collections/feedRequests';
import requestCenter from '../component/collections/requestCenter';
import confirmRequests from '../component/collections/confirmRequests';
import approvedEggDeliveryRequests from '../component/Dashboards/approvedEggDeliveryRequests.vue'
import approvedDeliveryRequests from '../component/Dashboards/approvedDeliveryRequests.vue'

const AgentRoutes = [
  //admin routes
 
  {
    path: '/agent-dashboard',
    component: AgentDashBoard,
    name: 'agent-dashboard',
    for: 'agent',
  },

  //Arnold collection agents weights routes
  {
    path:'/weights',
    component: weightsManagement,
    name:'egg-weights',
    for:'agent',
  },
  {
    path:'/delivery-weights',
    component:deliveryWeights,
    name:'eggweights',
    for:'agent',
  },
  {
    path:'/feedrequests',
    component:feedRequests,
    name:'feed-requests',
    for:'agent',
  },
  {
    path:'/request-center',
    component:requestCenter,
    name:'requestcenter',
    for:'agent',
  },
  {
    path:'/confirm-request',
    component:confirmRequests,
    name: 'confirmrequest',
    for:'agent',
  },
  {
    path:'/approved-egg-delivery-requests',
    component:approvedEggDeliveryRequests,
    name: 'approvedeggdeliveryrequest',
    for:'agent',
  },
  {
    path:'/approved-delivery-requests',
    component:approvedDeliveryRequests,
    name: 'approveddeliveryrequests',
    for:'agent',
  }


];

export default AgentRoutes;
