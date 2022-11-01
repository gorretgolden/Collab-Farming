import Request from '../component/mixins/requestHelper';
import permissionCheck from './checkPermission';

const routeGuard = (to, from) => {
  const authCheck = Request.getToken ();
  if (
    // make sure the user is authenticated
    !authCheck &&
    // ❗️ Avoid an infinite redirect
    to.name !== 'login'
  ) {
    // redirect the user to the login page
    return {name: 'login'};
  }

  //redirect to the dashboad when the user  is accessing the login page when logged in

  if (
    // make sure the user is authenticated
    authCheck &&
    // ❗️ Avoid an infinite redirectcom
    to.name === 'login'
  ) {
    // redirect the user to the login page
    return {name: 'dashboad'};
  }

  if (authCheck && to.name === 'dashboad') {
    //check weather permission esxist  for the admin
    const admin_perm = permissionCheck ('admin');

    //redirect to fanmis admin dashboard  when permmision is allowed

    if (admin_perm) {
      return {name: 'dashboard-admin'};
    }
    //check weather permision exists fro the enumerator
    const enumerator_perm = permissionCheck ('enum');

    //redirect to enumerator dashboard when result is true
    if (enumerator_perm) {
      return {name: 'dashboard-enumerator'};
    }

    //check weather permision exists for a Farmer
    const farmer_perm = permissionCheck ('farm');

    //redirect to Farmer dashboard when result is true
    if (farmer_perm) {
      return {name: 'farmer-dashboard'};
    }

    //check weather permision exists for a Account
    const account_perm = permissionCheck ('account');

    //redirect to Account dashboard when result is true
    if (account_perm) {
      return {name: 'account-dashboard'};
    }

    //check weather permision exists for a Account
    const agent_perm = permissionCheck ('agent');

    //redirect to Account dashboard when result is true
    if (agent_perm) {
        
      return {name: 'agent-dashboard'};
    }

    //console.log (enumerator_perm, admin_perm);
  }
};

export default routeGuard;
