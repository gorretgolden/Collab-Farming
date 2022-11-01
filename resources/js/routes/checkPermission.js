import Request from '../component/mixins/requestHelper';

const permissionCheck = userType => {
  const permission = Request.getUser ().roleArray;

  //check weather permision exists fro the enumerator
  return Array.isArray (permission) ? permission.includes (userType) : false;
};

export default permissionCheck;
