import EnumDashBoard from '../component/Dashboards/enumeratorDashboad';
import EggProducerProfiling from '../component/enumerator/profiling/index';
import FarmerProfiling from '../component/enumerator/profiling/farmerProfiling.vue'
import Report from '../component/enumerator/reports/index';
import EditFarmer from '../component/enumerator/profiling/editFarmerProfile.vue'

const EnumeratorRoutes = [
  //admin routes

  {
    path: '/fanmis-enumerator',
    component: EnumDashBoard,
    name: 'dashboard-enumerator',
    for: 'enum',
  },

  {
    path: '/egg-producer-profiling/:id?',
    component: EggProducerProfiling,
    name: 'egg-producer-profiling',
    for: 'enum',
  },
  {
    path: '/farmer-profiling',
    component: FarmerProfiling,
    name: 'farmer-profiling',
    for: 'enum',
  },
  {
    path: '/edit-farmer-profiling/:id?',
    component: EditFarmer,
    name: 'edit-farmer-profiling',
    for: 'enum',
  },
  {
    path: '/enumerator-reports',
    component: Report,
    name: 'enumerator-reports',
    for: 'enum',
  },
];

export default EnumeratorRoutes;
