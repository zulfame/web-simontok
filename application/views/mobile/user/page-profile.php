 <!-- App Capsule -->
 <div id="appCapsule">

     <div class="section mt-2">
         <div class="profile-head">
             <div class="avatar">
                 <img src="<?= base_url('assets/'); ?>img/profile/<?= $user['image']; ?>" alt="avatar" class="imaged w64">
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
                     <a class="nav-link active" href="<?= base_url('mobile/user/profile'); ?>">
                         <ion-icon name="person-outline"></ion-icon>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="<?= base_url('mobile/user/password'); ?>">
                         <ion-icon name="key-outline"></ion-icon>
                     </a>
                 </li>
             </ul>
         </div>
     </div>


     <!-- tab content -->
     <div class="section full mb-2">
         <div class="tab-content">
             <!-- Profile -->
             <div class="tab-pane fade show active" id="profile" role="tabpanel">
                 <?= form_open_multipart('mobile/user/profile'); ?>
                 <div class="mt-2 pr-2 pl-2">

                     <?= $this->session->flashdata('message'); ?>
                     <?= $this->session->flashdata('message_failed'); ?>

                     <div class="form-group boxed">
                         <div class="input-wrapper">
                             <?= form_error('name', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                             <label class="form-label">Name</label>
                             <input type="name" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" placeholder=" Full Name">
                             <i class="clear-input">
                                 <ion-icon name="close-circle"></ion-icon>
                             </i>
                         </div>
                     </div>

                     <div class="form-group boxed">
                         <div class="input-wrapper">
                             <label class="form-label">Email</label>
                             <input type="email" class="form-control" readonly value="<?= $user['email']; ?>">
                             <i class="clear-input">
                                 <ion-icon name="close-circle"></ion-icon>
                             </i>
                         </div>
                     </div>

                     <div class="form-group boxed">
                         <div class="input-wrapper">
                             <label class="form-label">Regitered</label>
                             <input type="text" class="form-control" readonly value="<?= date('d F Y', $user['date_created']) ?>">
                             <i class="clear-input">
                                 <ion-icon name="close-circle"></ion-icon>
                             </i>
                         </div>
                     </div>

                     <div class="form-group boxed">
                        <div class="input-wrapper">
                            <div class="custom-file-upload" id="fileUpload1" style="height:120px;">
                                <input type="file" id="UploadProfile" accept=".png, .jpg, .jpeg" name="image" id="image">
                                <label for="UploadProfile">
                                    <span>
                                        <strong>
                                            <ion-icon name="cloud-upload-outline"></ion-icon>
                                            <i>Tap to Upload</i>
                                        </strong>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                 </div>
                 <div class="pr-2 pl-2">
                     <button type="submit" class="btn btn-primary btn-block">Save and Change</button>
                 </div>
                 </form>
             </div>
             <!-- * Profile -->
         </div>
     </div>
     <!-- * tab content -->

 </div>
 <!-- * App Capsule -->