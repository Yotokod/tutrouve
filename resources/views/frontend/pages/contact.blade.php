@extends('frontend.layout.master')

@section('content')
    <!-- Contact Hero Section -->
    <div style="padding: 80px 0; background: linear-gradient(135deg, #1a1f3a 0%, #0f172a 100%); text-align: center;">
        <div class="container-1440">
            <h1 style="color: #ffffff; font-size: 3rem; font-weight: 700; margin-bottom: 20px; line-height: 1.2;">
                {{ __('Nous contacter') }}
            </h1>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #93bd93, #a8cca8); border-radius: 2px; margin: 0 auto 20px;"></div>
            <p style="color: #b0b0b0; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.8;">
                {{ __('Avez-vous des questions ? Nous serions ravis de vous entendre.') }}
            </p>
        </div>
    </div>

    <!-- Contact Content -->
    <div style="padding: 80px 0; background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 100%);">
        <div class="container-1440">
            <div class="row g-5">
                <!-- Contact Info -->
                <div class="col-lg-4">
                    <!-- Address -->
                    <div style="
                        background: rgba(147, 189, 147, 0.1);
                        backdrop-filter: blur(10px);
                        border-radius: 16px;
                        padding: 30px;
                        border: 1px solid rgba(147, 189, 147, 0.3);
                        margin-bottom: 30px;
                    ">
                        <div style="font-size: 36px; color: #93bd93; margin-bottom: 16px;">
                            <i class="las la-map-marker"></i>
                        </div>
                        <h3 style="color: #ffffff; font-size: 1.2rem; font-weight: 600; margin-bottom: 12px;">
                            {{ __('Adresse') }}
                        </h3>
                        <p style="color: #b0b0b0; margin: 0; line-height: 1.6;">
                            {{ get_static_option('site_address') ?? __('123 Rue Principale, Ville, Pays') }}
                        </p>
                    </div>

                    <!-- Email -->
                    <div style="
                        background: rgba(147, 189, 147, 0.1);
                        backdrop-filter: blur(10px);
                        border-radius: 16px;
                        padding: 30px;
                        border: 1px solid rgba(147, 189, 147, 0.3);
                        margin-bottom: 30px;
                    ">
                        <div style="font-size: 36px; color: #93bd93; margin-bottom: 16px;">
                            <i class="las la-envelope"></i>
                        </div>
                        <h3 style="color: #ffffff; font-size: 1.2rem; font-weight: 600; margin-bottom: 12px;">
                            {{ __('Email') }}
                        </h3>
                        <a href="mailto:{{ get_static_option('site_email') }}" style="color: #93bd93; text-decoration: none; transition: color 0.3s;"
                           onmouseover="this.style.color='#7da97d'" onmouseout="this.style.color='#93bd93'">
                            {{ get_static_option('site_email') ?? 'info@example.com' }}
                        </a>
                    </div>

                    <!-- Phone -->
                    <div style="
                        background: rgba(147, 189, 147, 0.1);
                        backdrop-filter: blur(10px);
                        border-radius: 16px;
                        padding: 30px;
                        border: 1px solid rgba(147, 189, 147, 0.3);
                    ">
                        <div style="font-size: 36px; color: #93bd93; margin-bottom: 16px;">
                            <i class="las la-phone"></i>
                        </div>
                        <h3 style="color: #ffffff; font-size: 1.2rem; font-weight: 600; margin-bottom: 12px;">
                            {{ __('Téléphone') }}
                        </h3>
                        <a href="tel:{{ get_static_option('site_phone') }}" style="color: #93bd93; text-decoration: none; transition: color 0.3s;"
                           onmouseover="this.style.color='#7da97d'" onmouseout="this.style.color='#93bd93'">
                            {{ get_static_option('site_phone') ?? '+1 (555) 000-0000' }}
                        </a>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div style="
                        background: rgba(147, 189, 147, 0.1);
                        backdrop-filter: blur(10px);
                        border-radius: 16px;
                        padding: 40px;
                        border: 1px solid rgba(147, 189, 147, 0.3);
                    ">
                        <form action="{{ route('frontend.form.builder.custom.submit') }}" method="POST">
                            @csrf

                            <div style="margin-bottom: 24px;">
                                <label style="display: block; color: #ffffff; font-weight: 600; margin-bottom: 8px;">
                                    {{ __('Nom') }} <span style="color: #ff6b6b;">*</span>
                                </label>
                                <input type="text" name="name" required
                                       style="
                                           width: 100%;
                                           padding: 12px 16px;
                                           background: rgba(255, 255, 255, 0.08);
                                           border: 1px solid rgba(147, 189, 147, 0.3);
                                           border-radius: 8px;
                                           color: #ffffff;
                                           font-size: 14px;
                                           transition: all 0.3s;
                                       "
                                       onfocus="this.style.background='rgba(255, 255, 255, 0.12)'; this.style.borderColor='rgba(147, 189, 147, 0.6)'"
                                       onblur="this.style.background='rgba(255, 255, 255, 0.08)'; this.style.borderColor='rgba(147, 189, 147, 0.3)'"
                                       placeholder="{{ __('Votre nom') }}">
                                <style>
                                    input::placeholder {
                                        color: #7a7a7a;
                                    }
                                </style>
                            </div>

                            <div style="margin-bottom: 24px;">
                                <label style="display: block; color: #ffffff; font-weight: 600; margin-bottom: 8px;">
                                    {{ __('Email') }} <span style="color: #ff6b6b;">*</span>
                                </label>
                                <input type="email" name="email" required
                                       style="
                                           width: 100%;
                                           padding: 12px 16px;
                                           background: rgba(255, 255, 255, 0.08);
                                           border: 1px solid rgba(147, 189, 147, 0.3);
                                           border-radius: 8px;
                                           color: #ffffff;
                                           font-size: 14px;
                                           transition: all 0.3s;
                                       "
                                       onfocus="this.style.background='rgba(255, 255, 255, 0.12)'; this.style.borderColor='rgba(147, 189, 147, 0.6)'"
                                       onblur="this.style.background='rgba(255, 255, 255, 0.08)'; this.style.borderColor='rgba(147, 189, 147, 0.3)'"
                                       placeholder="{{ __('votre.email@exemple.com') }}">
                            </div>

                            <div style="margin-bottom: 24px;">
                                <label style="display: block; color: #ffffff; font-weight: 600; margin-bottom: 8px;">
                                    {{ __('Sujet') }} <span style="color: #ff6b6b;">*</span>
                                </label>
                                <input type="text" name="subject" required
                                       style="
                                           width: 100%;
                                           padding: 12px 16px;
                                           background: rgba(255, 255, 255, 0.08);
                                           border: 1px solid rgba(147, 189, 147, 0.3);
                                           border-radius: 8px;
                                           color: #ffffff;
                                           font-size: 14px;
                                           transition: all 0.3s;
                                       "
                                       onfocus="this.style.background='rgba(255, 255, 255, 0.12)'; this.style.borderColor='rgba(147, 189, 147, 0.6)'"
                                       onblur="this.style.background='rgba(255, 255, 255, 0.08)'; this.style.borderColor='rgba(147, 189, 147, 0.3)'"
                                       placeholder="{{ __('Quel est le sujet ?') }}">
                            </div>

                            <div style="margin-bottom: 24px;">
                                <label style="display: block; color: #ffffff; font-weight: 600; margin-bottom: 8px;">
                                    {{ __('Message') }} <span style="color: #ff6b6b;">*</span>
                                </label>
                                <textarea name="message" required rows="6"
                                          style="
                                              width: 100%;
                                              padding: 12px 16px;
                                              background: rgba(255, 255, 255, 0.08);
                                              border: 1px solid rgba(147, 189, 147, 0.3);
                                              border-radius: 8px;
                                              color: #ffffff;
                                              font-size: 14px;
                                              transition: all 0.3s;
                                              resize: vertical;
                                              font-family: inherit;
                                          "
                                          onfocus="this.style.background='rgba(255, 255, 255, 0.12)'; this.style.borderColor='rgba(147, 189, 147, 0.6)'"
                                          onblur="this.style.background='rgba(255, 255, 255, 0.08)'; this.style.borderColor='rgba(147, 189, 147, 0.3)'"
                                          placeholder="{{ __('Votre message...') }}"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                    style="
                                        width: 100%;
                                        padding: 14px 20px;
                                        background: linear-gradient(135deg, #93bd93, #7da97d);
                                        color: white;
                                        border: none;
                                        border-radius: 8px;
                                        font-weight: 600;
                                        font-size: 16px;
                                        cursor: pointer;
                                        transition: all 0.3s;
                                    "
                                    onmouseover="this.style.background='linear-gradient(135deg, #7da97d, #6b9769)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(147, 189, 147, 0.4)'"
                                    onmouseout="this.style.background='linear-gradient(135deg, #93bd93, #7da97d)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <i class="las la-paper-plane"></i> {{ __('Envoyer le message') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
