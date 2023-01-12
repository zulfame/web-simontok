 <!-- App Capsule -->
 <div id="appCapsule">

     <div class="section mt-2">
         <div class="profile-head">
             <div class="avatar">
                 <img src="<?= base_url('assets/'); ?>img/profile/<?= $user['image']; ?>" alt="avatar" class="imaged w64 rounded">
             </div>
             <div class="in">
                 <h3 class="name"><?= $user['name']; ?></h3>
                 <h5 class="subtext"><?= $user['role']; ?></h5>
             </div>
         </div>
     </div>

     <div class="section mt-1 mb-2">
         <div class="profile-info">
             <div class=" bio">

             </div>
             <div class="link">
             </div>
         </div>
     </div>

     <div class="section full">
         <div class="wide-block transparent p-0">
             <ul class="nav nav-tabs lined iconed" role="tablist">
                 <li class="nav-item">
                     <a class="nav-link" href="<?= base_url('mobile/user/profile'); ?>">
                         <ion-icon name="person-outline"></ion-icon>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link active" href="<?= base_url('mobile/user/password'); ?>">
                         <ion-icon name="key-outline"></ion-icon>
                     </a>
                 </li>
             </ul>
         </div>
     </div>


     <!-- tab content -->
     <div class="section full mb-2">
         <div class="tab-content">
             <!-- * password -->
             <div class="tab-pane fade show active" id="password" role="tabpanel">
                 <form class="form-horizontal" action="<?= base_url('mobile/user/password'); ?>" method="post">
                     <div class="mt-2 pr-2 pl-2">

                         <?= $this->session->flashdata('message'); ?>
                         <?= $this->session->flashdata('message_failed'); ?>

                         <div class="form-group boxed">
                             <div class="input-wrapper">
                                 <?= form_error('current_password', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                                 <label class="form-label">Current Password</label>
                                 <input type="password" inputmode="numeric" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                                 <i class="clear-input">
                                     <ion-icon name="close-circle"></ion-icon>
                                 </i>
                             </div>
                         </div>

                         <div class="form-group boxed">
                             <div class="input-wrapper">
                                 <?= form_error('new_password1', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                                 <label class="form-label">New Password</label>
                                 <input type="password" inputmode="numeric" class="form-control" id="new_password1" name="new_password1" placeholder="New Password">
                                 <i class="clear-input">
                                     <ion-icon name="close-circle"></ion-icon>
                                 </i>
                             </div>
                         </div>

                         <div class="form-group boxed">
                             <div class="input-wrapper">
                                 <?= form_error('new_password2', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                                 <label class="form-label">Repeat Password</label>
                                 <input type="password" inputmode="numeric" class="form-control" id="new_password2" name="new_password2" placeholder="Password (again)">
                                 <i class="clear-input">
                                     <ion-icon name="close-circle"></ion-icon>
                                 </i>
                             </div>
                         </div>

                     </div>
                     <div class="pr-2 pl-2">
                         <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                     </div>
                 </form>
             </div>

         </div>
     </div>
     <!-- * tab content -->

 </div>
 <!-- * App Capsule -->