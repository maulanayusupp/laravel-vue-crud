<template>
    <div>
      <h1>Company Details</h1>

      <div>
        <p><strong>Name:</strong> {{ company.name }}</p>
        <p><strong>Email:</strong> {{ company.email }}</p>
        <img v-if="company.logo" :src="'/storage/' + company.logo" alt="Company Logo" width="100" height="100" />
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
      company: Object
    }
  };
  </script>
