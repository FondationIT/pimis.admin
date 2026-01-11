{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="{{  asset('vendors/business_card/css/style.css') }}" rel="stylesheet" type="text/css">
  <title>Panzi Agent Business Card</title>
</head>
<body>

  <div class="card">
    @if($user)
    <img src="https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png" alt="Business Owner" class="profile-image">
    <div class="card-content">
      <h2>{{ $user->firstname." ".$user->lastname." ".$user->middlename }}</h2>
      <h3>{{ $user->service }}</h3>
      <h4>{{ $user->position }}</h4>
      <p>{{ $user->description }}</p>
      <div class="contact-info">
        <a href="mailto:{{ $user->email }}" title="Email">&#9993;</a>
        <a href="tel:{{ $user->phone }}" title="Phone">&#9742;</a>
        <a href="#" title="LinkedIn">&#128100;</a>
      </div>
    </div>
    @else
    <p> L'utilisateur est introuvable. </p>
    @endif
  </div>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humanitarian Agent Business Card</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            
          <div class="top-images-wrapper" style="--bg-lft-color: #f5bf5fff;">
            <img src="imgs/img3.jpg" alt="Victim transformed into survivor" class="block-image-1">
            <p class="block-text">Où les victimes sont transformées en survivantes</p>
          </div>
          <div class="top-images-wrapper" style="--bg-lft-color: #528febff;">
            <img src="imgs/img2.jpg" alt="Healing survivors" class="block-image-2">
            <p class="block-text">Guérir les survivants, transformer les communautés</p>
          </div>
            <!-- <div class="left-content-block block-top animate-left delay-0"> -->
              <!-- </div> -->
              
              <!-- <div class="left-content-block block-bottom animate-left delay-2"> -->
            <!-- </div> -->
        </div>

        <div class="right-panel">
            <div class="header">
                <img src="imgs/panzi-wht-lg.png" alt="Panzi Logo" class="panzi-logo">
            </div>
            <div class="card-area">
                <div class="business-card">
                    <div class="card-photo-section">
                        <div class="profile-photo-circle">
                            PHOTO
                        </div>
                    </div>
                    <div class="card-details-section">
                        <p class="card-name">{{ $user->firstname." ".$user->lastname }}</p>
                        <p class="card-title">{{ $user->middlename }}</p>
                        <div class="contact-info">
                            <p class="position-label">{{ $user->position }}</p>
                            <div class="contact-item">
                                <i class="fas fa-phone-alt"></i>
                                <span>{{ $user->phone }}</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $user->email }}</span>
                            </div>
                            <div class="contact-item social-icons">
                                <i class="fab fa-linkedin"></i>
                                <i class="fas fa-link"></i>
                            </div>
                            <div class="status">
                                <span class="status-dot"></span> Active
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <p>Carte de Visite</p>
                <div class="agent-humanitaire">
                  <span class="agt">Agent</span>
                  <span class="humanitaire">Humanitaire</span>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
