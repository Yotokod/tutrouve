@extends('backend.admin-master')
@section('site-title')
    {{__('Media Images Settings')}}
@endsection
@section('style')
    <x-media.css/>
    <style>
        /* Modern Media Library Styles */
        :root {
            --primary-color: #1F3E39;
            --primary-light: #2d5850;
            --secondary-color: #f8fafc;
            --border-color: #e2e8f0;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --shadow-sm: 0 2px 8px rgba(31, 62, 57, 0.08);
            --shadow-md: 0 4px 16px rgba(31, 62, 57, 0.12);
            --shadow-lg: 0 8px 32px rgba(31, 62, 57, 0.16);
        }

        .media-library-container {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
        }

        /* Header with glassmorphism */
        .media-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .media-header-left h4 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 8px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .media-stats {
            display: flex;
            gap: 24px;
            margin-top: 8px;
        }

        .media-stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 14px;
        }

        .media-stat-badge {
            background: linear-gradient(135deg, rgba(31, 62, 57, 0.1), rgba(45, 88, 80, 0.1));
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* Toolbar */
        .media-toolbar {
            background: white;
            padding: 20px 32px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 280px;
            max-width: 400px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: var(--secondary-color);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 4px rgba(31, 62, 57, 0.1);
        }

        .search-box svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .filter-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .filter-select {
            padding: 10px 16px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-select:hover {
            border-color: var(--primary-color);
        }

        .view-mode-toggle {
            display: flex;
            gap: 8px;
            background: var(--secondary-color);
            padding: 4px;
            border-radius: 10px;
        }

        .view-mode-btn {
            padding: 8px 12px;
            border: none;
            background: transparent;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-muted);
        }

        .view-mode-btn.active {
            background: white;
            color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        /* Modern Grid Layout */
        .media-grid-container {
            padding: 32px;
        }

        .media-uploader-image-list.media-page {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .media-uploader-image-list.media-page li {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background: white;
            border: 2px solid transparent;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }

        .media-uploader-image-list.media-page li:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        .media-uploader-image-list.media-page li.selected {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(31, 62, 57, 0.2);
        }

        .attachment-preview {
            position: relative;
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .attachment-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .media-uploader-image-list.media-page li:hover .attachment-preview img {
            transform: scale(1.1);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 12px;
        }

        .media-uploader-image-list.media-page li:hover .image-overlay {
            opacity: 1;
        }

        .image-info-badge {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 11px;
            color: var(--text-dark);
            font-weight: 600;
        }

        .selection-checkbox {
            position: absolute;
            top: 12px;
            left: 12px;
            width: 24px;
            height: 24px;
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 6px;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            display: none;
        }

        .media-uploader-image-list.media-page li:hover .selection-checkbox,
        .media-uploader-image-list.media-page li.selected .selection-checkbox {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .media-uploader-image-list.media-page li.selected .selection-checkbox {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .selection-checkbox svg {
            color: white;
            width: 14px;
            height: 14px;
        }

        /* Sidebar Preview Panel */
        .media-sidebar {
            background: white;
            border-left: 1px solid var(--border-color);
            height: calc(100vh - 200px);
            overflow-y: auto;
            position: sticky;
            top: 100px;
        }

        .media-uploader-image-info {
            padding: 24px;
        }

        .preview-empty-state {
            text-align: center;
            padding: 48px 24px;
            color: var(--text-muted);
        }

        .preview-empty-state svg {
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .img-wrapper {
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 24px;
            background: var(--secondary-color);
            box-shadow: var(--shadow-md);
        }

        .img-wrapper img {
            width: 100%;
            height: auto;
            display: block;
        }

        .img-info h5 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
            word-break: break-all;
        }

        .img-meta {
            list-style: none;
            padding: 0;
            margin: 0 0 24px;
        }

        .img-meta li {
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            justify-content: space-between;
        }

        .img-meta li:last-child {
            border-bottom: none;
        }

        .img-meta li strong {
            color: var(--text-dark);
            font-weight: 600;
        }

        .img-alt-wrap {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .img-alt-wrap input {
            flex: 1;
            padding: 10px 14px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 13px;
        }

        .img-alt-wrap input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .img_alt_submit_btn {
            padding: 10px 16px;
            background: linear-gradient(135deg, var(--success-color), #059669);
            border: none;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .img_alt_submit_btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .action-btn {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .action-btn.copy-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
        }

        .action-btn.delete-btn {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Bulk Actions Bar */
        .bulk-actions-bar {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            padding: 16px 32px;
            border-radius: 50px;
            box-shadow: 0 8px 32px rgba(31, 62, 57, 0.4);
            display: flex;
            align-items: center;
            gap: 24px;
            z-index: 1000;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .bulk-actions-bar.active {
            transform: translateX(-50%) translateY(0);
        }

        .bulk-actions-bar .count {
            font-weight: 700;
            font-size: 16px;
        }

        .bulk-action-btn {
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bulk-action-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .media-uploader-image-list.media-page li {
            animation: fadeInUp 0.4s ease forwards;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .media-uploader-image-list.media-page {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 16px;
            }
        }

        @media (max-width: 768px) {
            .media-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .media-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: 100%;
            }

            .media-uploader-image-list.media-page {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 12px;
            }

            .media-grid-container {
                padding: 16px;
            }
        }

        .display-none {
            display: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="row g-4 mt-0">
        <div class="col-xl-12 col-lg-12 mt-0">
            <div class="media-library-container">
                <!-- Modern Header -->
                <div class="media-header">
                    <div class="media-header-left">
                        <h4>{{ __('Médiathèque') }}</h4>
                        <div class="media-stats">
                            <div class="media-stat-item">
                                <span>{{ __('Total') }}:</span>
                                <span class="media-stat-badge">{{ $all_media_images->count() }}</span>
                            </div>
                            <div class="media-stat-item">
                                <span>{{ __('Espace utilisé') }}:</span>
                                <span class="media-stat-badge">{{ number_format($all_media_images->sum('size') / 1024 / 1024, 2) }} MB</span>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard__inner__header__right">
                        <a href="#" class="cmnBtn btn_5 btn_bg_blue radius-5" data-bs-toggle="modal" data-bs-target="#media_image_upload_modal" style="display: flex; align-items: center; gap: 8px;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{__('Ajouter des images')}}
                        </a>
                    </div>
                </div>

                <x-validation.error/>

                <!-- Toolbar with Search and Filters -->
                <div class="media-toolbar">
                    <div class="search-box">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" id="mediaSearch" placeholder="{{ __('Rechercher par nom...') }}">
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="sortBy">
                            <option value="date-desc">{{ __('Plus récent') }}</option>
                            <option value="date-asc">{{ __('Plus ancien') }}</option>
                            <option value="name-asc">{{ __('Nom A-Z') }}</option>
                            <option value="name-desc">{{ __('Nom Z-A') }}</option>
                            <option value="size-desc">{{ __('Taille décroissante') }}</option>
                            <option value="size-asc">{{ __('Taille croissante') }}</option>
                        </select>
                        <select class="filter-select" id="filterSize">
                            <option value="all">{{ __('Toutes tailles') }}</option>
                            <option value="small">{{ __('< 500 KB') }}</option>
                            <option value="medium">{{ __('500 KB - 2 MB') }}</option>
                            <option value="large">{{ __('> 2 MB') }}</option>
                        </select>
                    </div>
                    <div class="view-mode-toggle">
                        <button class="view-mode-btn active" data-view="grid">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z"/>
                            </svg>
                        </button>
                        <button class="view-mode-btn" data-view="list">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="row g-0">
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="media-grid-container">
                            <ul class="media-uploader-image-list media-page" id="mediaImagesList">
                                @foreach($all_media_images as $index => $image)
                                    <li data-date="{{$image->updated_at->timestamp}}"
                                        data-imgid="{{$image->id}}"
                                        data-imgsrc="{{asset('assets/uploads/media-uploader/'.$image->path)}}"
                                        data-size="{{$image->size}}"
                                        data-dimension="{{$image->dimensions}}"
                                        data-title="{{$image->title}}"
                                        data-alt="{{$image->alt}}"
                                        style="animation-delay: {{$index * 0.05}}s">
                                        <div class="selection-checkbox" data-id="{{$image->id}}">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <div class="attachment-preview">
                                            {!! render_image_markup_by_attachment_id($image->id,'','grid') !!}
                                            <div class="image-overlay">
                                                <div class="image-info-badge">
                                                    {{ number_format($image->size / 1024, 0) }} KB
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="media-sidebar">
                            <div class="media-uploader-image-info" id="media-uploader-image-info">
                                <div class="preview-empty-state">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p>{{ __('Sélectionnez une image pour voir les détails') }}</p>
                                </div>
                                <div class="img-wrapper display-none">
                                    <img src="" alt="">
                                </div>
                                <div class="img-info display-none">
                                    <h5 class="img-title"></h5>
                                    <ul class="img-meta">
                                        <li><strong>{{ __('ID') }}:</strong> <span class="image_id"></span></li>
                                        <li><strong>{{ __('Date') }}:</strong> <span class="date"></span></li>
                                        <li><strong>{{ __('Dimensions') }}:</strong> <span class="dimension"></span></li>
                                        <li><strong>{{ __('Taille') }}:</strong> <span class="size"></span></li>
                                        <li class="imgalt">
                                            <div style="margin-top: 8px;">
                                                <strong style="display: block; margin-bottom: 8px;">{{ __('Texte alternatif') }}:</strong>
                                                <div class="img-alt-wrap">
                                                    <input type="text" name="img_alt_tag" placeholder="{{ __('Entrer le texte alt...') }}">
                                                    <button class="img_alt_submit_btn">
                                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="action-buttons">
                                        <button class="action-btn copy-btn" type="button" id="copyUrlBtn">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            {{ __('Copier URL') }}
                                        </button>
                                    </div>
                                    <form method="post" action="{{route('admin.upload.media.file.delete')}}" class="delete_image_form">
                                        @csrf
                                        <input type="hidden" name="img_id" id="info_image_id_input">
                                        <button type="submit" class="action-btn delete-btn">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            {{ __('Supprimer') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions Bar -->
    <div class="bulk-actions-bar" id="bulkActionsBar">
        <span class="count"><span id="selectedCount">0</span> {{ __('sélectionnés') }}</span>
        <button class="bulk-action-btn" id="deselectAll">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            {{ __('Désélectionner') }}
        </button>
        <button class="bulk-action-btn" id="bulkDelete" style="background: rgba(239, 68, 68, 0.3); border-color: rgba(239, 68, 68, 0.5);">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            {{ __('Supprimer') }}
        </button>
    </div>

    <!-- media upload Modal -->
    <div class="modal fade" id="media_image_upload_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal_xl__fixed">
            <div class="popup_contents modal-content">
                <div class="popup_contents__header">
                    <div class="popup_contents__header__flex">
                        <div class="popup_contents__header__contents">
                            <h2 class="popup_contents__header__title">{{ __('Upload Images') }}</h2>
                        </div>
                        <div class="popup_contents__header__close" data-bs-dismiss="modal">
                            <span class="popup_contents__close popup_close"> <i class="fas fa-times"></i> </span>
                        </div>
                    </div>
                </div>
                <div class="popup_contents__body">
                    <div class="alert alert-warning">{{__('Reload the page to see latest uploaded images')}}</div>
                    <div class="dragDrop_item dragDropWrapper mt-4">
                        <div class="dragDrop__area radius-10">
                            <div class="dragDrop__area__uploads dragDroparea">
                                <form action="{{route('admin.upload.media.file')}}" method="post" class="dropzone" enctype="multipart/form-data">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="popup_contents__footer flex_btn justify-content-end profile-border-top">
                        <a href="javascript:void(0)" class="cmnBtn btn_5 btn_bg_danger radius-5" data-bs-dismiss="modal">{{__('Cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('scripts')
    <x-media.js/>
    <script>
        (function($){
            "use strict";

            let selectedImages = new Set();
            let allImages = [];

            $(document).ready(function (){
                // Initialize
                loadAllImages();
                initializeImageSelection();
                initializeSearch();
                initializeFilters();
                initializeBulkActions();
                initializeCopyUrl();

                // Load all images data
                function loadAllImages() {
                    $('.media-uploader-image-list.media-page li').each(function() {
                        allImages.push({
                            element: $(this),
                            id: $(this).data('imgid'),
                            date: $(this).data('date'),
                            title: $(this).data('title'),
                            size: $(this).data('size'),
                            dimension: $(this).data('dimension'),
                            imgsrc: $(this).data('imgsrc'),
                            alt: $(this).data('alt')
                        });
                    });
                }

                // Image Selection
                function initializeImageSelection() {
                    // Click on image to select/view details
                    $('.media-uploader-image-list.media-page').on('click', 'li', function(e) {
                        if (!$(e.target).closest('.selection-checkbox').length) {
                            $('.media-uploader-image-list.media-page li').removeClass('selected');
                            $(this).addClass('selected');
                            showImageDetails($(this));
                        }
                    });

                    // Checkbox selection
                    $('.media-uploader-image-list.media-page').on('click', '.selection-checkbox', function(e) {
                        e.stopPropagation();
                        const li = $(this).closest('li');
                        const imgId = $(this).data('id');

                        if (li.hasClass('selected')) {
                            li.removeClass('selected');
                            selectedImages.delete(imgId);
                        } else {
                            li.addClass('selected');
                            selectedImages.add(imgId);
                        }

                        updateBulkActionsBar();
                    });
                }

                // Show image details in sidebar
                function showImageDetails($image) {
                    const imgSrc = $image.data('imgsrc');
                    const imgTitle = $image.data('title');
                    const imgDate = new Date($image.data('date') * 1000).toLocaleDateString('fr-FR');
                    const imgDimension = $image.data('dimension');
                    const imgSize = (parseInt($image.data('size')) / 1024).toFixed(2) + ' KB';
                    const imgId = $image.data('imgid');
                    const imgAlt = $image.data('alt');

                    // Update sidebar
                    $('.preview-empty-state').addClass('display-none');
                    $('.img-wrapper').removeClass('display-none');
                    $('.img-info').removeClass('display-none');
                    
                    $('.img-wrapper img').attr('src', imgSrc);
                    $('.img-title').text(imgTitle);
                    $('.image_id').text(imgId);
                    $('.date').text(imgDate);
                    $('.dimension').text(imgDimension);
                    $('.size').text(imgSize);
                    $('input[name="img_alt_tag"]').val(imgAlt || '');
                    $('#info_image_id_input').val(imgId);
                    $('.imgsrc').text(imgSrc);
                }

                // Search functionality
                function initializeSearch() {
                    let searchTimeout;
                    $('#mediaSearch').on('input', function() {
                        clearTimeout(searchTimeout);
                        const query = $(this).val().toLowerCase();
                        
                        searchTimeout = setTimeout(function() {
                            filterAndSortImages();
                        }, 300);
                    });
                }

                // Filter functionality
                function initializeFilters() {
                    $('#sortBy, #filterSize').on('change', function() {
                        filterAndSortImages();
                    });
                }

                // Filter and sort images
                function filterAndSortImages() {
                    const searchQuery = $('#mediaSearch').val().toLowerCase();
                    const sortBy = $('#sortBy').val();
                    const filterSize = $('#filterSize').val();

                    let filteredImages = allImages.filter(img => {
                        // Search filter
                        const matchesSearch = img.title.toLowerCase().includes(searchQuery) || 
                                            img.alt.toLowerCase().includes(searchQuery);
                        if (!matchesSearch) return false;

                        // Size filter
                        const sizeKB = parseInt(img.size) / 1024;
                        if (filterSize === 'small' && sizeKB >= 500) return false;
                        if (filterSize === 'medium' && (sizeKB < 500 || sizeKB > 2048)) return false;
                        if (filterSize === 'large' && sizeKB <= 2048) return false;

                        return true;
                    });

                    // Sort
                    filteredImages.sort((a, b) => {
                        switch(sortBy) {
                            case 'date-desc':
                                return b.date - a.date;
                            case 'date-asc':
                                return a.date - b.date;
                            case 'name-asc':
                                return a.title.localeCompare(b.title);
                            case 'name-desc':
                                return b.title.localeCompare(a.title);
                            case 'size-desc':
                                return parseInt(b.size) - parseInt(a.size);
                            case 'size-asc':
                                return parseInt(a.size) - parseInt(b.size);
                            default:
                                return 0;
                        }
                    });

                    // Update DOM
                    const $list = $('.media-uploader-image-list.media-page');
                    $list.empty();
                    
                    filteredImages.forEach((img, index) => {
                        img.element.css('animation-delay', (index * 0.05) + 's');
                        $list.append(img.element);
                    });

                    // Show no results message
                    if (filteredImages.length === 0) {
                        $list.html('<li style="grid-column: 1/-1; text-align: center; padding: 48px; color: #64748b;">{{ __("Aucune image trouvée") }}</li>');
                    }
                }

                // Bulk actions
                function initializeBulkActions() {
                    $('#deselectAll').on('click', function() {
                        $('.media-uploader-image-list.media-page li').removeClass('selected');
                        selectedImages.clear();
                        updateBulkActionsBar();
                    });

                    $('#bulkDelete').on('click', function() {
                        if (selectedImages.size === 0) return;

                        if (confirm('{{ __("Êtes-vous sûr de vouloir supprimer") }} ' + selectedImages.size + ' {{ __("images ?") }}')) {
                            // TODO: Implement bulk delete via AJAX
                            console.log('Bulk delete:', Array.from(selectedImages));
                            alert('{{ __("Fonctionnalité de suppression en masse à implémenter") }}');
                        }
                    });
                }

                function updateBulkActionsBar() {
                    $('#selectedCount').text(selectedImages.size);
                    
                    if (selectedImages.size > 0) {
                        $('#bulkActionsBar').addClass('active');
                    } else {
                        $('#bulkActionsBar').removeClass('active');
                    }
                }

                // Copy URL functionality
                function initializeCopyUrl() {
                    $('#copyUrlBtn').on('click', function() {
                        const url = $('.imgsrc').text();
                        
                        if (navigator.clipboard) {
                            navigator.clipboard.writeText(url).then(function() {
                                showCopyNotification();
                            });
                        } else {
                            // Fallback for older browsers
                            const $temp = $('<input>');
                            $('body').append($temp);
                            $temp.val(url).select();
                            document.execCommand('copy');
                            $temp.remove();
                            showCopyNotification();
                        }
                    });
                }

                function showCopyNotification() {
                    const $btn = $('#copyUrlBtn');
                    const originalText = $btn.html();
                    
                    $btn.html('<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> {{ __("Copié !") }}');
                    
                    setTimeout(function() {
                        $btn.html(originalText);
                    }, 2000);
                }

                // Alt tag update
                $('.img_alt_submit_btn').on('click', function(e) {
                    e.preventDefault();
                    const imgId = $('#info_image_id_input').val();
                    const altText = $('input[name="img_alt_tag"]').val();
                    
                    $.ajax({
                        url: '{{ route("admin.upload.media.file.alt.change") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            imgid: imgId,
                            alt: altText
                        },
                        success: function(response) {
                            // Update in memory
                            const img = allImages.find(i => i.id == imgId);
                            if (img) {
                                img.alt = altText;
                                img.element.data('alt', altText);
                            }
                            
                            // Show success animation
                            const $btn = $('.img_alt_submit_btn');
                            $btn.css('background', 'linear-gradient(135deg, #10b981, #059669)');
                            setTimeout(function() {
                                $btn.css('background', '');
                            }, 500);
                        },
                        error: function() {
                            alert('{{ __("Erreur lors de la mise à jour") }}');
                        }
                    });
                });

                // View mode toggle
                $('.view-mode-btn').on('click', function() {
                    $('.view-mode-btn').removeClass('active');
                    $(this).addClass('active');
                    
                    const view = $(this).data('view');
                    const $list = $('.media-uploader-image-list.media-page');
                    
                    if (view === 'list') {
                        $list.css('grid-template-columns', '1fr');
                        $('.attachment-preview').css('height', '80px');
                    } else {
                        $list.css('grid-template-columns', 'repeat(auto-fill, minmax(180px, 1fr))');
                        $('.attachment-preview').css('height', '180px');
                    }
                });

                // Smooth scroll for sticky sidebar
                $(window).on('scroll', function () {
                    const scrolltop = $(window).scrollTop();
                    const mtop = Math.max(0, scrolltop - 200);
                    $('#media-uploader-image-info').parent().css({marginTop: mtop + 'px'});
                });
            });
        })(jQuery);
    </script>
@endsection
