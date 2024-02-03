<style>
   .navbar sup {
   background-color: {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .play-button {
   background-color: {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .aside .sidebar a.active {
   color: {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .aside .sidebar a .active span {
   color: {{ optional($user)->color ?? '#FFFFFF' }};
   }

   .aside .sidebar a.active:before {
   background-color: {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   aside .sidebar .message-count {
   background-color: {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .active {
   background-color: {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .primary {
   color: {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .line {
   border-bottom: 4px solid {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .strim-btn {
   background-color: {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .launcher-dl-button {
   border: 3px solid {{ optional($user)->color ?? '#FFFFFF' }};
   box-shadow: 5px 5px {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .launcher-dl-button:active {
   box-shadow: 0px 0px {{ optional($user)->color ?? '#FFFFFF' }};
   }
   
   .card button {
   background-color: {{ optional($user)->color ?? '#FFFFFF' }};
   }

   .button-all-games {
   background-color: {{ optional($user)->color ?? '#FFFFFF' }};
   }
</style>