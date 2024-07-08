<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ($settings->page_title)? $settings->page_title : Laravel}}</title>
    <link rel="icon" href="{{ asset('frontend/images/settings/'.$settings->favicon) }}" sizes="32x32" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="{{ asset('frontend') }}/style.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/style2.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/style3.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/style5.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Meta Pixel Code --> <script> !function(f,b,e,v,n,t,s) {if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)}; if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; n.queue=[];t=b.createElement(e);t.async=!0; t.src=v;s=b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s)}(window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '1568120447319824'); fbq('track', 'PageView'); </script> <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1568120447319824&ev=PageView&noscript=1" /></noscript> <!-- End Meta Pixel Code -->
  </head>
  @php
    $banner = \App\Models\Banner::first();
  @endphp
  <!-- banner section start -->
   <section class="main_banner" style="background-image: url({{ asset('images/banner/'.$banner->image) }})">
   </section>

  <!-- banner section end -->
    <!-- header_part start -->
    @if ($settings->title)
    <!-- top header start  -->
 <div class="container">
      <div class="row justify-content-center pt-3">
        <div class="res">
          <p class="fw-bold">
            {{-- সকাল থেকে সন্ধ্যা কর্মস্থলে ফিট থাকতে এবং নানা প্রকার চর্মরোগ থেকে
            নিজে এবং পরিবারের সদস্যদের সুস্থ্য রাখতে চাইলে আরামদায়ক এই প্যাকটি
            আপনার জন্য। --}}
            {{ $settings->title }}
          </p>
        </div>
      </div>
    </div>
    @endif

    <!-- top header end  -->
    <section class="product_background">
      <div class="container-fluid">
        @if ($featuredImage)
            <div class="rows">
                @foreach ($featuredImage as $image)
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="product_wrapper">
                        <div class="product">
                            <img src="{{ asset('frontend/images/featured_images/'.$image->image) }}" class="img-fluid w-100" />
                        </div>
                        <a class="btn_order" href="#checkout-order"
                            ><i class="fa-solid fa-cart-shopping"></i> অর্ডার করতে চাই (
                            অফার মুল্য
                            @if ($settings->old_price)
                                <del style="color: #a80000">{{ $settings->old_price }}</del>
                            @endif
                            @if ($settings->new_price)
                                {{ $settings->new_price }}
                            @endif টাকা )
                        </a>
                        <!-- <div class="inner_button">
                            <a class="btn_offer"
                            >অফার মুল্য <del style="color: black">৭৯০</del> ৫৯০ টাকা</a
                            >
                        </div> -->
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="product_wrapper">
                    <div class="product">
                        <img src="{{ asset('frontend') }}/images/loom_2.jfif" class="img-fluid w-100" />
                    </div>
                    <a class="btn_order" href="#checkout-order"
                        ><i class="fa-solid fa-cart-shopping"></i> অর্ডার করতে চাই (
                        অফার মুল্য <del style="color: #a80000">৭৯০</del> ৫৯০ টাকা )
                    </a>
                    <!-- <div class="inner_button">
                        <a class="btn_offer"
                        >অফার মুল্য <del style="color: black">৭৯০</del> ৫৯০ টাকা</a
                        >
                    </div> -->
                    </div>
                </div> --}}
            </div>
        @endif

        <!-- call button start -->
        @if (!empty($settings->call_to_action) && !empty($settings->phone))
            <div class="row text-center my-3">
            <div class="call_button">
                <a
                class="col-md-4 m-auto btn text-white fw-bold p-3"
                href="tel:+88{{ $settings->phone }}"
                >
                {{ $settings->call_to_action }} : {{ $settings->phone }}
                <i class="fa-solid fa-phone-flip"></i>
                </a>
            </div>
            </div>
        @endif
        <!-- call button end -->
      </div>
    </section>

    <!-- header_part_end -->
@if ($contents)
    @foreach ($contents as $key => $content)
        @if ($key == 0)
            <!-- users section startr -->
            <section class="users">
            <div class="container">
                <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="heading_title">
                    <h2 class="text-center">{{ $content->title }}</h2>
                    </div>
                    <div class="users_line">
                    <ul>
                        <li>
                            @if ($content->details)
                                @foreach ($content->details as $key => $details)
                                    @if ($key == 0)
                                        <div class="list_iteam">
                                            <span class="icon_check">
                                            <i class="fa-solid fa-check"></i>
                                            </span>
                                            <span class="line_text">
                                            {{-- চাকুরিজীবী এবং ব্যাবসায়ী ভাইদের জন্য যারা সপ্তাহে ৫-৬ দিন
                                            সকাল থেকে সন্ধ্যা কর্মস্থলে কিংবা বাইরে থাকেন। --}}
                                            {{ $details->content }}
                                            </span>
                                        </div>
                                    @else

                                        <div class="underline"></div>
                                        <div class="list_iteam">
                                            <span class="icon_check">
                                            <i class="fa-solid fa-check"></i>
                                            </span>
                                            <span class="line_text">
                                            {{-- যারা চান সপ্তাহের প্রতিটি দিন তার প্রোডাক্টিভ কাটুক। --}}
                                            {{ $details->content }}
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        {{-- <div class="underline"></div>
                        <div class="list_iteam">
                            <span class="icon_check">
                            <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="line_text">
                            যারা অতীতে খারাপ মানহীন আন্ডারওয়্যার পরে অনেক সমস্যার
                            মুখোমুখি হয়েছেন।
                            </span>
                        </div>
                        <div class="underline"></div>
                        <div class="list_iteam">
                            <span class="icon_check">
                            <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="line_text">
                            যারা বুঝেন যে ইনার পার্টের সুস্থতা একজন পুরুষের জন্য কতটা
                            জরুরী ।
                            </span>
                        </div>
                        <div class="underline"></div>
                        <div class="list_iteam">
                            <span class="icon_check">
                            <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="line_text">
                            নানা প্রকার চর্ম রোগ থেকে যারা নিজে বাচতে চান এবং পরিবারকে
                            বাচাতে চান।
                            </span>
                        </div> --}}
                        <!-- <div class="underline"></div> -->
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            </section>
            <!-- users_section_end -->
        @else
            <!-- why choose us setion start -->
            <section class="choose_us">
            <div class="container">
                <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="heading_title_chooseus">
                    <h2 class="text-center">
                        {{-- কেনো আপনার এই কম্বো প্যাকটি কেনা উচিৎ? --}}
                        {{ $content->title }}
                    </h2>
                    </div>
                    <div class="users_line">
                    <ul>
                        <li>
                            @if ($content->details)
                            @foreach ($content->details as $key => $details)
                                @if ($key == 0)
                                    <div class="list_iteam">
                                        <span class="icon_check">
                                        <i class="fa-solid fa-check"></i>
                                        </span>
                                        <span class="line_text">
                                        {{-- চাকুরিজীবী এবং ব্যাবসায়ী ভাইদের জন্য যারা সপ্তাহে ৫-৬ দিন
                                        সকাল থেকে সন্ধ্যা কর্মস্থলে কিংবা বাইরে থাকেন। --}}
                                        {{ $details->content }}
                                        </span>
                                    </div>
                                @else

                                    <div class="underline"></div>
                                    <div class="list_iteam">
                                        <span class="icon_check">
                                        <i class="fa-solid fa-check"></i>
                                        </span>
                                        <span class="line_text">
                                        {{-- যারা চান সপ্তাহের প্রতিটি দিন তার প্রোডাক্টিভ কাটুক। --}}
                                        {{ $details->content }}
                                        </span>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        {{-- <div class="list_iteam">
                            <span class="icon_check">
                            <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="line_text">
                            ৩ টি বক্সার ব্রিফে পুরো সপ্তাহ অনায়াসে পার হবে।
                            </span>
                        </div>
                        <div class="underline"></div>
                        <div class="list_iteam">
                            <span class="icon_check">
                            <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="line_text">
                            নিজস্ব ডিজাইনারের পারফেক্ট প্যাটার্নে তৈরি।
                            </span>
                        </div>
                        <div class="underline"></div>
                        <div class="list_iteam">
                            <span class="icon_check">
                            <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="line_text">
                            প্রোডাক্টে ৯৫% কম্বড কম্পেক্ট কটন এবং ৫% স্পান্ডেক্স সুতায়
                            তৈরি কাপড় ব্যবহার করা হয়েছে যা নিশ্চিত করবে ১০০ ভাগ
                            কম্পোর্টনেস।
                            </span>
                        </div>
                        <div class="underline"></div>
                        <div class="list_iteam">
                            <span class="icon_check">
                            <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="line_text">
                            ফাংগাল ইনফেকশন প্রতিরোধক ফিনিস এবং মুহুর্তেই ঘাম শোষন করার
                            ক্ষমতা রয়েছে এই কাপড়ে।
                            </span>
                        </div>
                        <div class="underline"></div>
                        <div class="list_iteam">
                            <span class="icon_check">
                            <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="line_text">
                            আরামদায়ক বেষ্ট কোয়ালিটির এই বক্সার ব্রিফ সারাদিন আপনাকে
                            রাখবে সতেজ-চনমনে যাতে আপনি একটি প্রোডাক্টিভ দিন অতিবাহিত
                            করতে পারেন।
                            </span>
                        </div> --}}
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            </section>
            <!-- users_section_end -->
        @endif
    @endforeach

@endif

<!-- Size guide start-->
@if ($settings->size_guide)
    <section class="size_guide">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="users_line text-center">
              <img src="{{ asset('frontend/images/settings/'.$settings->size_guide) }}" class="img-fluid w-100" />
            </div>
          </div>
        </div>
      </div>
    </section>
@endif
    <!-- Size guide end-->

    <!-- order section start -->
    <div class="order_section">
      <div class="container">
        <div class="order_inner">
          <div class="title">
            <h2 class="heading-title">{{ isset($settings->order_title)? $settings->order_title : 'অর্ডার করতে নিচের ফর্মটি পূরন করুন'}}</h2>
          </div>
          <div class="title">
            <h2 class="bellow-heading-title">
              {{ isset($settings->order_sub_title)? $settings->order_sub_title :'কোন কারনে আপনার পছন্দ না হলে আপনি ডেলিভারি ফি প্রদান করে রিটার্ন
              করতে পারবেন।' }}
            </h2>
          </div>
          <!-- CHECKOUT SHORTCODE -->

          <div class="checkout" id="checkout-order">
            <form
              name="checkout"
              class="form-checkout"
            >
            @csrf
              <div class="product_option">
                <h3 id="your_products_heading">
                    {{ isset($settings->order_sub_sub_title)? $settings->order_sub_sub_title :'আপনার পছন্দের প্যাক নির্বাচন করুন' }}
                </h3>
                <div class="product-qty-options" id="myTable">
                  <div class="product-qty-row">
                    <div class="wcf-qty-header product-item">
                      <div class="row-label">Product</div>
                    </div>
                    <div class="wcf-qty-header product-qty">
                      <div class="row-label">Quantity</div>
                    </div>
                    <div class="wcf-qty-header product-price">
                      <div class="row-label">Price</div>
                    </div>
                  </div>
                  @if ($products)
                    @foreach ($products as $product)
                      <div class="product-qty-row" data-options='{"product_id":{{ $product->id }},"name":"{{ $product->name }}","price":"{{ $product->price }}","img":"{{ asset('frontend/images/'.$product->image) }}"}'>
                        <div class="product-item">
                          <div class="product-item-selector wcf-item-multiple-sel">
                            <input
                              class="wcf-multiple-sel"
                              type="checkbox"
                              name="wcf-multiple-sel"
                              value="{{ $product->id }}"
                              @checked(old('wcf-multiple-sel',0) === 1)
                              onchange="update_amounts()"
                            />
                          </div>

                          <div class="product-item-image">
                            <picture
                              fetchpriority="high"
                              decoding="async"
                              class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                            >
                              <source
                                type="image/webp"
                                srcset="{{ asset('frontend/images/'.$product->image) }}"
                              />
                              <img
                                fetchpriority="high"
                                decoding="async"
                                width="100"
                                height="100"
                                src="{{ asset('frontend/images/'.$product->image) }}"
                                alt=""
                              />
                            </picture>
                          </div>

                          <div class="wcf-item-all-text">
                            <div class="wcf-item-wrap">
                              <span class="wcf-display-title">{{ $product->name }}</span
                              ><span class="wcf-display-title-quantity"
                                ><span class="dashicons dashicons-no-alt">x</span
                                ><span class="wcf-display-quantity">1</span></span
                              >
                            </div>
                          </div>
                        </div>

                        <div class="product-qty">
                          <div class="wcf-qty-selection-wrap">
                            <span
                              class="wcf-qty-selection-btn wcf-qty-decrement wcf-qty-change-icon"
                              title=""
                              >−</span
                            >
                            <input
                              autocomplete="off"
                              type="number"
                              value="1"
                              step="1"
                              min="1"
                              name="wcf_qty_selection"
                              class="wcf-qty-selection"
                              placeholder="1"
                              data-sale-limit="false"
                              title=""
                              readonly="true"
                            />
                            <span
                              class="wcf-qty-selection-btn wcf-qty-increment wcf-qty-change-icon"
                              title=""
                              >+</span
                            >
                          </div>
                        </div>
                        <div class="product-price">
                          <input type="hidden" class="price" value="{{ $product->price }}" />
                          <div class="wcf-display-price wcf-field-label">
                            <span class="woocommerce-Price-amount amount"
                              ><span class="woocommerce-Price-currencySymbol"
                                >৳&nbsp;</span
                              >{{ $product->price }}</span
                            >
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif

                  {{-- <div
                    class="product-qty-row"
                    data-options='{"product_id":3915,"variation_id":0,"type":"simple","unique_id":"97ag4u11","mode":"quantity","highlight_text":"","quantity":"1","default_quantity":1,"price":"590","img":"./images/loom_2.jfif","discounted_price":"","total_discounted_price":"","currency":"&amp;#2547;&amp;nbsp;","cart_item_key":"0e0df9b23c2a11603a6da71aa4902687","save_value":"","save_percent":"","sign_up_fee":0,"subscription_price":"790","trial_period_string":""}'
                  >
                    <div class="product-item">
                      <div class="product-item-selector wcf-item-multiple-sel">
                        <input
                          class="wcf-multiple-sel"
                          type="checkbox"
                          name="wcf-multiple-sel"
                          value="3914"
                          onchange="update_amounts()"
                        />
                      </div>

                      <div class="product-item-image">
                        <picture
                          fetchpriority="high"
                          decoding="async"
                          class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                        >
                          <source
                            type="image/webp"
                            srcset="{{ asset('frontend') }}/images/loom_2.jfif"
                          />
                          <img
                            fetchpriority="high"
                            decoding="async"
                            width="100"
                            height="100"
                            src="{{ asset('frontend') }}/images/loom_2.jfif"
                            alt=""
                          />
                        </picture>
                      </div>

                      <div class="wcf-item-all-text">
                        <div class="wcf-item-wrap">
                          <span class="wcf-display-title">Boxer Model-2</span
                          ><span class="wcf-display-title-quantity"
                            ><span class="dashicons dashicons-no-alt">x</span
                            ><span class="wcf-display-quantity">1</span></span
                          >
                        </div>
                      </div>
                    </div>

                    <div class="product-qty">
                      <div class="wcf-qty-selection-wrap">
                        <span
                          class="wcf-qty-selection-btn wcf-qty-decrement wcf-qty-change-icon"
                          title=""
                          >−</span
                        >
                        <input
                          autocomplete="off"
                          type="number"
                          value="1"
                          step="1"
                          min="1"
                          name="wcf_qty_selection"
                          class="wcf-qty-selection"
                          placeholder="1"
                          data-sale-limit="false"
                          title=""
                          readonly="false"
                        />
                        <span
                          class="wcf-qty-selection-btn wcf-qty-increment wcf-qty-change-icon"
                          title=""
                          >+</span
                        >
                      </div>
                    </div>
                    <div class="product-price">
                      <input type="hidden" class="price" value="590" />
                      <div class="wcf-display-price wcf-field-label">
                        <span class="woocommerce-Price-amount amount"
                          ><span class="woocommerce-Price-currencySymbol"
                            >৳&nbsp;</span
                          >590</span
                        >
                      </div>
                    </div>
                  </div>
                  <div --}}
                    {{-- class="product-qty-row"
                    data-options='{"product_id":3916,"variation_id":0,"type":"simple","unique_id":"97ag4u11","mode":"quantity","highlight_text":"","quantity":"1","default_quantity":1,"price":"590","img":"{{ asset("frontend") }}/images/loom_4.jpeg","discounted_price":"","total_discounted_price":"","currency":"&amp;#2547;&amp;nbsp;","cart_item_key":"0e0df9b23c2a11603a6da71aa4902687","save_value":"","save_percent":"","sign_up_fee":0,"subscription_price":"790","trial_period_string":""}'
                  >
                    <div class="product-item">
                      <div class="product-item-selector wcf-item-multiple-sel">
                        <input
                          class="wcf-multiple-sel"
                          type="checkbox"
                          onchange="update_amounts()"
                          name="wcf-multiple-sel"
                          value="3914"
                        />
                      </div>

                      <div class="product-item-image">
                        <picture
                          fetchpriority="high"
                          decoding="async"
                          class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                        >
                          <source
                            type="image/webp"
                            srcset="{{ asset('frontend') }}/images/loom_4.jpeg"
                          />
                          <img
                            fetchpriority="high"
                            decoding="async"
                            width="100"
                            height="100"
                            src="{{ asset('frontend') }}/images/loom_4.jpeg"
                            alt=""
                          />
                        </picture>
                      </div>

                      <div class="wcf-item-all-text">
                        <div class="wcf-item-wrap">
                          <span class="wcf-display-title">Boxer Model-3</span
                          ><span class="wcf-display-title-quantity"
                            ><span class="dashicons dashicons-no-alt">x</span
                            ><span class="wcf-display-quantity">1</span></span
                          >
                        </div>
                      </div>
                    </div>

                    <div class="product-qty">
                      <div class="wcf-qty-selection-wrap">
                        <span
                          class="wcf-qty-selection-btn wcf-qty-decrement wcf-qty-change-icon"
                          title=""
                          >−</span
                        >
                        <input
                          autocomplete="off"
                          type="number"
                          value="1"
                          step="1"
                          min="1"
                          name="wcf_qty_selection"
                          class="wcf-qty-selection"
                          placeholder="1"
                          data-sale-limit="false"
                          title=""
                          readonly="false"
                        />
                        <span
                          class="wcf-qty-selection-btn wcf-qty-increment wcf-qty-change-icon"
                          title=""
                          >+</span
                        >
                      </div>
                    </div>
                    <div class="product-price">
                      <input type="hidden" class="price" value="590" />
                      <div class="wcf-display-price wcf-field-label">
                        <span class="woocommerce-Price-amount amount"
                          ><span class="woocommerce-Price-currencySymbol"
                            >৳&nbsp;</span
                          >590</span
                        >
                      </div>
                    </div>
                  </div> --}}
                </div>
              </div>
              {{-- @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif --}}
        <div>
          <ul id="message"></ul>
        </div>
              <div class="wcf-col2-set col2-set" id="customer_details">
                <div class="wcf-col-1 col-1">
                  <div class="woocommerce-billing-fields">
                    <h3 id="billing_fields_heading">Billing details</h3>

                    <div class="woocommerce-billing-fields__field-wrapper">
                      <p
                        class="form-row form-row-first wcf-column-100 validate-required"
                        id="billing_first_name_field"
                        data-priority="10"
                      >
                        <label for="billing_first_name" class=""
                          >নাম&nbsp;<abbr class="required" title="required"
                            >*</abbr
                          ></label
                        ><span class="woocommerce-input-wrapper"
                          ><input
                            type="text"
                            class="input-text"
                            name="name"
                            id="billing_first_name"
                            placeholder=""
                            value=""
                            autocomplete="given-name"
                            required
                        /></span>
                      </p>
                      <p
                        class="form-row form-row-wide address-field update_totals_on_change wcf-column-100 validate-required"
                        id="billing_country_field"
                        data-priority="40"
                      >
                        <label for="billing_country" class=""
                          >Country / Region&nbsp;<abbr
                            class="required"
                            title="required"
                            >*</abbr
                          ></label
                        ><span class="woocommerce-input-wrapper"
                          ><strong>Bangladesh</strong
                          ><input
                            type="hidden"
                            name="billing_country"
                            id="billing_country"
                            value="BD"
                            autocomplete="country"
                            class="country_to_state"
                            readonly="readonly"
                        /></span>
                      </p>
                      <p
                        class="form-row address-field wcf-column-100 validate-required form-row-wide"
                        id="billing_address_1_field"
                        data-priority="50"
                      >
                        <label for="billing_address_1" class=""
                          >ঠিকানা&nbsp;<abbr class="required" title="required"
                            >*</abbr
                          ></label
                        ><span class="woocommerce-input-wrapper"
                          ><input
                            type="text"
                            class="input-text"
                            name="address"
                            id="billing_address_1"
                            placeholder="House number and street name"
                            value=""
                            required
                            autocomplete="address-line1"
                        /></span>
                      </p>
                      <p
                        class="form-row form-row-wide wcf-column-100 validate-required validate-phone"
                        id="billing_phone_field"
                        data-priority="100"
                      >
                        <label for="billing_phone" class=""
                          >ফোন নাম্বার&nbsp;<abbr
                            class="required"
                            title="required"
                            >*</abbr
                          ></label
                        ><span class="woocommerce-input-wrapper"
                          ><input
                            type="tel"
                            class="input-text"
                            name="phone"
                            id="billing_phone"
                            maxlength="11"
                            placeholder=""
                            value=""
                            required
                            autocomplete="tel"
                        /></span>
                      </p>
                      <p
                        class="form-row form-row-wide wcf-column-100 wcf-input-radio-field-wrapper validate-required"
                        id="billing_size_field"
                        data-priority="120"
                      >
                        <label for="billing_size_M size" class="input-radio"
                          >সাইজ&nbsp;<abbr class="required" title="required"
                            >*</abbr
                          ></label
                        ><span class="woocommerce-input-wrapper" id="size_id"
                          >
                          @if ($sizes)
                            @foreach ($sizes as $size)
                              <input
                            type="radio"
                            class="input-radio"
                            value="{{ $size->id }}"
                            name="size_id"
                            id="billing_size_{{ $size->size }}"
                            checked
                          /><label
                            for="billing_size_{{ $size->size }}"
                            class="radio input-radio"
                            >{{ $size->size }}</label
                          >
                            @endforeach
                          @endif
                          {{-- <input
                            type="radio"
                            class="input-radio"
                            value="L size"
                            name="billing_size"
                            id="billing_size_L size"
                          /><label
                            for="billing_size_L size"
                            class="radio input-radio"
                            >L size</label
                          ><input
                            type="radio"
                            class="input-radio"
                            value="XL size"
                            name="billing_size"
                            id="billing_size_XL size"
                          /><label
                            for="billing_size_XL size"
                            class="radio input-radio"
                            >XL size</label
                          ><input
                            type="radio"
                            class="input-radio"
                            value="XXL size"
                            name="billing_size"
                            id="billing_size_XXL size"
                          /><label
                            for="billing_size_XXL size"
                            class="radio input-radio"
                            >XXL size</label
                          ><input
                            type="radio"
                            class="input-radio"
                            value="XXXL size"
                            name="billing_size"
                            id="billing_size_XXXL size"
                          /><label
                            for="billing_size_XXXL size"
                            class="radio input-radio"
                            >XXXL size</label
                          > --}}
                        </span>

                      </p>
                    </div>
                  </div>
                </div>

                <div class="wcf-col-2 col-2">
                  <div class="woocommerce-shipping-fields"></div>
                  <div class="woocommerce-additional-fields">

                  </div>
                </div>
              </div>

              <div class="wcf-order-wrap">
                <h3 id="order_review_heading">Your order</h3>

                <div
                  id="order_review"
                  class="woocommerce-checkout-review-order"
                >
                  <table
                    class="shop_table woocommerce-checkout-review-order-table"
                  >
                    <thead>
                      <tr>
                        <th class="product-name">Product</th>
                        <th class="product-total">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody id="cart-item">
                      <tr class="cart_item">
                        <td class="product-name">
                          <div class="wcf-product-image">
                            <div class="wcf-product-thumbnail">
                              <img
                                width="50"
                                height="50"
                                src="{{ asset('frontend') }}/images/loom_2.jfif"
                                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                alt=""
                              />
                            </div>
                            <div class="wcf-product-name">boxer Model-2</div>
                          </div>
                          &nbsp;
                          <strong class="product-quantity">×&nbsp;1</strong>
                        </td>
                        <td class="product-total">
                          <span class="woocommerce-Price-amount amount"
                            ><bdi
                              ><span class="woocommerce-Price-currencySymbol"
                                >৳&nbsp;</span
                              >790</bdi
                            ></span
                          >
                        </td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr class="cart-subtotal">
                        <th>Subtotal</th>
                        <td>
                          <span class="woocommerce-Price-amount amount"
                            >
                            <input type="hidden" name="subtotal" id="cart-subtotal">
                            <bdi id="cart-total-amount"
                              ><span class="woocommerce-Price-currencySymbol"
                                >৳&nbsp;</span
                              >0</bdi
                            ></span
                          >
                        </td>
                      </tr>

                      <tr class="woocommerce-shipping-totals shipping">
                        <th>Shipping</th>
                        <td data-title="Shipping">
                            <input type="text" hidden value="{{ $settings->free }}" id="freeShipping">
                            @if ($settings->free == 1)
                            Free Delivery
                            @else

                            <ul
                              id="shipping_method"
                              class="woocommerce-shipping-methods"
                            >
                              <li>
                                <input
                                  type="radio"
                                  name="shipping_method"
                                  id="shipping_method_0_flat_rate1"
                                  value="{{ $settings->outside_dhaka }}"
                                  class="shipping_method"
                                  onclick="wishlistDetails()"
                                  checked="checked"
                                /><label for="shipping_method_0_flat_rate1"
                                  >ঢাকার বাহিরে:
                                  <span class="woocommerce-Price-amount amount"
                                    ><bdi
                                      ><span
                                        class="woocommerce-Price-currencySymbol"
                                        >৳&nbsp;</span
                                      >{{ $settings->outside_dhaka }}</bdi
                                    ></span
                                  ></label
                                >
                              </li>
                              <li>
                                <input
                                  type="radio"
                                  name="shipping_method"
                                  id="shipping_method_0_flat_rate2"
                                  value="{{ $settings->inside_dhaka }}"
                                  onclick="wishlistDetails()"
                                  class="shipping_method"
                                /><label for="shipping_method_0_flat_rate2"
                                  >ঢাকার ভিতরে:
                                  <span class="woocommerce-Price-amount amount"
                                    ><bdi
                                      ><span
                                        class="woocommerce-Price-currencySymbol"
                                        >৳&nbsp;</span
                                      >{{ $settings->inside_dhaka }}</bdi
                                    ></span
                                  ></label
                                >
                              </li>
                            </ul>
                            @endif
                        </td>
                      </tr>

                      <tr class="order-total">
                        <th>Total</th>
                        <td>
                          <strong
                            ><span class="woocommerce-Price-amount amount"
                              ><bdi id="total-payment"
                                ><span class="woocommerce-Price-currencySymbol"
                                  >৳&nbsp;</span
                                >890</bdi
                              ></span
                            ></strong
                          >
                        </td>
                      </tr>
                    </tfoot>
                  </table>

                  <div id="payment" class="woocommerce-checkout-payment">
                    <ul class="wc_payment_methods payment_methods methods">
                      <li class="wc_payment_method payment_method_cod">
                        <input
                          id="payment_method_cod"
                          type="radio"
                          class="input-radio"
                          name="payment_method"
                          value="cod"
                          checked="checked"
                          data-order_button_text=""
                          style="display: none"
                        />

                        <label for="payment_method_cod">
                          ক্যাশঅন ডেলিভারি
                        </label>
                        <div class="payment_box payment_method_cod">
                          <p>{{ isset($settings->order_message)? $settings->order_message: 'Pay with cash upon delivery.' }}</p>
                        </div>
                      </li>
                    </ul>
                    <div class="form-row place-order">
                      <noscript>
                        Since your browser does not support JavaScript, or it is
                        disabled, please ensure you click the
                        <em>Update Totals</em> button before placing your order.
                        You may be charged more than the amount stated above if
                        you fail to do so. <br /><button
                          type="submit"
                          class="button alt"
                          name="woocommerce_checkout_update_totals"
                          value="Update totals"
                        >
                          Update totals
                        </button>
                      </noscript>

                      <div class="woocommerce-terms-and-conditions-wrapper">
                        <div class="woocommerce-privacy-policy-text"></div>
                      </div>

                      <div
                        class="wcf-bump-order-grid-wrap wcf-all-bump-order-wrap wcf-after-payment"
                        data-update-time="1711956457"
                      ></div>
                      <button
                        type="button"
                        class="button alt"
                        name="woocommerce_checkout_place_order"
                        id="place_order"
                        order-url="{{ route('place.order') }}"
                        data-value="Place Order&nbsp;&nbsp;৳&nbsp;890"
                      >
                        Place Order&nbsp;&nbsp;৳&nbsp;890
                      </button>

                      <!-- <input
                        type="hidden"
                        id="woocommerce-process-checkout-nonce"
                        name="woocommerce-process-checkout-nonce"
                        value="fa8543a4c9"
                      /><input
                        type="hidden"
                        name="_wp_http_referer"
                        value="/step/casual-shirt-m-1-9/?wc-ajax=update_order_review&amp;wcf_checkout_id=3902"
                      /> -->
                    </div>
                  </div>
                </div>
              </div>

            </form>
          </div>
          <!-- END CHECKOUT SHORTCODE -->
        </div>
      </div>
    </div>

    <footer>
      <div class="footer">
        <div>
            <label for="track">Track Order</label>
            <input type="text" class="" name="trackOrder" value="" placeholder="COT-xxxxxx-xx">
            <input type="text" class="" name="orderStatus" id="orderStatus" placeholder="Order Status" readonly>
        </div>
            <h3>Design & Development by Zariq Ltd</h3>
      </div>
    </footer>

    <!-- order section end -->
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/custom.js"></script>
  </body>
</html>
