@extends('layout.layout-mahasiswa')

@section('title', 'Beranda')

@section('main')
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-8">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Hallo {{ $user->name }}</h5>
                            <strong>{{ $skripsi->judul }}</strong>
                            <p class="mx-auto">
                                Kamu telah menyelesaikan <span class="fw-bold"
                                    style="color: 
                                    @if ($skripsi->progres == 0) #8592a3; /* abu-abu jika progres 0 */
                                    @elseif($skripsi->progres <= 50) 
                                        #ffab00; /* kuning jika progres 1-50 */
                                    @elseif($skripsi->progres <= 99) 
                                        #007bff; /* biru jika progres 51-99 */
                                    @else
                                        #71dd37; /* hijau jika progres 100 */ @endif">
                                    {{ $skripsi->progres }}%
                                </span> Skripsi kamu.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xxl-6 mb-4 order-1 order-xxl-3">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Progres Skripsi</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="deliveryExceptions" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <div id="deliveryExceptionsChart" style="min-height: 391.8px;">
                        <div id="apexchartsugrjzucg" class="apexcharts-canvas apexchartsugrjzucg apexcharts-theme-light"
                            style="width: 406px; height: 391.8px;"><svg id="SvgjsSvg2247" width="406"
                                height="391.79999999999995" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                style="background: transparent;">
                                <foreignObject x="0" y="0" width="406" height="391.79999999999995">
                                    <div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom"
                                        xmlns="http://www.w3.org/1999/xhtml"
                                        style="inset: auto 0px -5px; position: absolute; max-height: 210px;">
                                        <div class="apexcharts-legend-series" rel="1" seriesname="Incorrectxaddress"
                                            data:collapsed="false" style="margin: 5px 15px;"><span
                                                class="apexcharts-legend-marker" rel="1" data:collapsed="false"
                                                style="background: rgb(113, 221, 55) !important; color: rgb(113, 221, 55); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span
                                                class="apexcharts-legend-text" rel="1" i="0"
                                                data:default-text="Incorrect%20address" data:collapsed="false"
                                                style="color: rgb(86, 106, 127); font-size: 13px; font-weight: 400; font-family: &quot;Public Sans&quot;;">Incorrect
                                                address</span></div>
                                        <div class="apexcharts-legend-series" rel="2" seriesname="Weatherxconditions"
                                            data:collapsed="false" style="margin: 5px 15px;"><span
                                                class="apexcharts-legend-marker" rel="2" data:collapsed="false"
                                                style="background: rgba(113, 221, 55, 0.6) !important; color: rgba(113, 221, 55, 0.6); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span
                                                class="apexcharts-legend-text" rel="2" i="1"
                                                data:default-text="Weather%20conditions" data:collapsed="false"
                                                style="color: rgb(86, 106, 127); font-size: 13px; font-weight: 400; font-family: &quot;Public Sans&quot;;">Weather
                                                conditions</span></div>
                                        <div class="apexcharts-legend-series" rel="3" seriesname="FederalxHolidays"
                                            data:collapsed="false" style="margin: 5px 15px;"><span
                                                class="apexcharts-legend-marker" rel="3" data:collapsed="false"
                                                style="background: rgba(113, 221, 55, 0.4) !important; color: rgba(113, 221, 55, 0.4); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span
                                                class="apexcharts-legend-text" rel="3" i="2"
                                                data:default-text="Federal%20Holidays" data:collapsed="false"
                                                style="color: rgb(86, 106, 127); font-size: 13px; font-weight: 400; font-family: &quot;Public Sans&quot;;">Federal
                                                Holidays</span></div>
                                        <div class="apexcharts-legend-series" rel="4"
                                            seriesname="Damagexduringxtransit" data:collapsed="false"
                                            style="margin: 5px 15px;"><span class="apexcharts-legend-marker"
                                                rel="4" data:collapsed="false"
                                                style="background: rgba(113, 221, 55, 0.2) !important; color: rgba(113, 221, 55, 0.2); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span
                                                class="apexcharts-legend-text" rel="4" i="3"
                                                data:default-text="Damage%20during%20transit" data:collapsed="false"
                                                style="color: rgb(86, 106, 127); font-size: 13px; font-weight: 400; font-family: &quot;Public Sans&quot;;">Damage
                                                during transit</span></div>
                                    </div>
                                    <style type="text/css">
                                        .apexcharts-legend {
                                            display: flex;
                                            overflow: auto;
                                            padding: 0 10px;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom,
                                        .apexcharts-legend.apx-legend-position-top {
                                            flex-wrap: wrap
                                        }

                                        .apexcharts-legend.apx-legend-position-right,
                                        .apexcharts-legend.apx-legend-position-left {
                                            flex-direction: column;
                                            bottom: 0;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                                        .apexcharts-legend.apx-legend-position-right,
                                        .apexcharts-legend.apx-legend-position-left {
                                            justify-content: flex-start;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                            justify-content: center;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                            justify-content: flex-end;
                                        }

                                        .apexcharts-legend-series {
                                            cursor: pointer;
                                            line-height: normal;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series,
                                        .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series {
                                            display: flex;
                                            align-items: center;
                                        }

                                        .apexcharts-legend-text {
                                            position: relative;
                                            font-size: 14px;
                                        }

                                        .apexcharts-legend-text *,
                                        .apexcharts-legend-marker * {
                                            pointer-events: none;
                                        }

                                        .apexcharts-legend-marker {
                                            position: relative;
                                            display: inline-block;
                                            cursor: pointer;
                                            margin-right: 3px;
                                            border-style: solid;
                                        }

                                        .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                                        .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                                            display: inline-block;
                                        }

                                        .apexcharts-legend-series.apexcharts-no-click {
                                            cursor: auto;
                                        }

                                        .apexcharts-legend .apexcharts-hidden-zero-series,
                                        .apexcharts-legend .apexcharts-hidden-null-series {
                                            display: none !important;
                                        }

                                        .apexcharts-inactive-legend {
                                            opacity: 0.45;
                                        }
                                    </style>
                                </foreignObject>
                                <g id="SvgjsG2249" class="apexcharts-inner apexcharts-graphical"
                                    transform="translate(12, 15)">
                                    <defs id="SvgjsDefs2248">
                                        <clipPath id="gridRectMaskugrjzucg">
                                            <rect id="SvgjsRect2251" width="388" height="310" x="-2" y="0"
                                                rx="0" ry="0" opacity="1" stroke-width="0"
                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="forecastMaskugrjzucg"></clipPath>
                                        <clipPath id="nonForecastMaskugrjzucg"></clipPath>
                                        <clipPath id="gridRectMarkerMaskugrjzucg">
                                            <rect id="SvgjsRect2252" width="388" height="314" x="-2" y="-2"
                                                rx="0" ry="0" opacity="1" stroke-width="0"
                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                        </clipPath>
                                    </defs>
                                    <g id="SvgjsG2253" class="apexcharts-pie">
                                        <g id="SvgjsG2254" transform="translate(0, 0) scale(1)">
                                            <circle id="SvgjsCircle2255" r="110.41463414634147" cx="192"
                                                cy="155" fill="transparent"></circle>
                                            <g id="SvgjsG2256" class="apexcharts-slices">
                                                <g id="SvgjsG2257" class="apexcharts-series apexcharts-pie-series"
                                                    seriesName="Incorrectxaddress" rel="1" data:realIndex="0">
                                                    <path id="SvgjsPath2258"
                                                        d="M 192 7.7804878048780495 A 147.21951219512195 147.21951219512195 0 0 1 299.3184057345278 54.221308990595986 L 272.4888043008959 79.41598174294698 A 110.41463414634147 110.41463414634147 0 0 0 192 44.58536585365853 L 192 7.7804878048780495 z"
                                                        fill="rgba(113,221,55,1)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-pie-area apexcharts-donut-slice-0"
                                                        index="0" j="0" data:angle="46.8" data:startAngle="0"
                                                        data:strokeWidth="0" data:value="13"
                                                        data:pathOrig="M 192 7.7804878048780495 A 147.21951219512195 147.21951219512195 0 0 1 299.3184057345278 54.221308990595986 L 272.4888043008959 79.41598174294698 A 110.41463414634147 110.41463414634147 0 0 0 192 44.58536585365853 L 192 7.7804878048780495 z">
                                                    </path>
                                                </g>
                                                <g id="SvgjsG2259" class="apexcharts-series apexcharts-pie-series"
                                                    seriesName="Weatherxconditions" rel="2" data:realIndex="1">
                                                    <path id="SvgjsPath2260"
                                                        d="M 299.3184057345278 54.221308990595986 A 147.21951219512195 147.21951219512195 0 0 1 292.77869100940404 262.3184057345278 L 267.584018257053 235.48880430089588 A 110.41463414634147 110.41463414634147 0 0 0 272.4888043008959 79.41598174294698 L 299.3184057345278 54.221308990595986 z"
                                                        fill="rgba(113, 221, 55, 0.6)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                        stroke-dasharray="0"
                                                        class="apexcharts-pie-area apexcharts-donut-slice-1"
                                                        index="0" j="1" data:angle="90.00000000000001"
                                                        data:startAngle="46.8" data:strokeWidth="0" data:value="25"
                                                        data:pathOrig="M 299.3184057345278 54.221308990595986 A 147.21951219512195 147.21951219512195 0 0 1 292.77869100940404 262.3184057345278 L 267.584018257053 235.48880430089588 A 110.41463414634147 110.41463414634147 0 0 0 272.4888043008959 79.41598174294698 L 299.3184057345278 54.221308990595986 z">
                                                    </path>
                                                </g>
                                                <g id="SvgjsG2261" class="apexcharts-series apexcharts-pie-series"
                                                    seriesName="FederalxHolidays" rel="3" data:realIndex="2">
                                                    <path id="SvgjsPath2262"
                                                        d="M 292.77869100940404 262.3184057345278 A 147.21951219512195 147.21951219512195 0 0 1 105.46654188201543 274.10308726944345 L 127.09990641151157 244.32731545208262 A 110.41463414634147 110.41463414634147 0 0 0 267.584018257053 235.48880430089588 L 292.77869100940404 262.3184057345278 z"
                                                        fill="rgba(113, 221, 55, 0.4)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                        stroke-dasharray="0"
                                                        class="apexcharts-pie-area apexcharts-donut-slice-2"
                                                        index="0" j="2" data:angle="79.19999999999999"
                                                        data:startAngle="136.8" data:strokeWidth="0" data:value="22"
                                                        data:pathOrig="M 292.77869100940404 262.3184057345278 A 147.21951219512195 147.21951219512195 0 0 1 105.46654188201543 274.10308726944345 L 127.09990641151157 244.32731545208262 A 110.41463414634147 110.41463414634147 0 0 0 267.584018257053 235.48880430089588 L 292.77869100940404 262.3184057345278 z">
                                                    </path>
                                                </g>
                                                <g id="SvgjsG2263" class="apexcharts-series apexcharts-pie-series"
                                                    seriesName="Damagexduringxtransit" rel="4" data:realIndex="3">
                                                    <path id="SvgjsPath2264"
                                                        d="M 105.46654188201543 274.10308726944345 A 147.21951219512195 147.21951219512195 0 0 1 191.97430534802058 7.7804900471594465 L 191.98072901101543 44.58536753536957 A 110.41463414634147 110.41463414634147 0 0 0 127.09990641151157 244.32731545208262 L 105.46654188201543 274.10308726944345 z"
                                                        fill="rgba(113, 221, 55, 0.2)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                        stroke-dasharray="0"
                                                        class="apexcharts-pie-area apexcharts-donut-slice-3"
                                                        index="0" j="3" data:angle="144" data:startAngle="216"
                                                        data:strokeWidth="0" data:value="40"
                                                        data:pathOrig="M 105.46654188201543 274.10308726944345 A 147.21951219512195 147.21951219512195 0 0 1 191.97430534802058 7.7804900471594465 L 191.98072901101543 44.58536753536957 A 110.41463414634147 110.41463414634147 0 0 0 127.09990641151157 244.32731545208262 L 105.46654188201543 274.10308726944345 z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                        <g id="SvgjsG2265" class="apexcharts-datalabels-group"
                                            transform="translate(0, 0) scale(1)"><text id="SvgjsText2266"
                                                font-family="Helvetica, Arial, sans-serif" x="192" y="175"
                                                text-anchor="middle" dominant-baseline="auto" font-size="0.7rem"
                                                font-weight="400" fill="#a1acb8"
                                                class="apexcharts-text apexcharts-datalabel-label"
                                                style="font-family: Helvetica, Arial, sans-serif;">AVG.
                                                Exceptions</text><text id="SvgjsText2267" font-family="Public Sans"
                                                x="192" y="141" text-anchor="middle" dominant-baseline="auto"
                                                font-size="26px" font-weight="500" fill="#566a7f"
                                                class="apexcharts-text apexcharts-datalabel-value"
                                                style="font-family: &quot;Public Sans&quot;;">30%</text></g>
                                    </g>
                                    <line id="SvgjsLine2268" x1="0" y1="0" x2="384"
                                        y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                        stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                    <line id="SvgjsLine2269" x1="0" y1="0" x2="384"
                                        y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                        class="apexcharts-ycrosshairs-hidden"></line>
                                </g>
                                <g id="SvgjsG2250" class="apexcharts-annotations"></g>
                            </svg>
                            <div class="apexcharts-tooltip apexcharts-theme-false">
                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                        class="apexcharts-tooltip-marker"
                                        style="background-color: rgb(113, 221, 55);"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                                <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                        class="apexcharts-tooltip-marker"
                                        style="background-color: rgba(113, 221, 55, 0.6);"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                                <div class="apexcharts-tooltip-series-group" style="order: 3;"><span
                                        class="apexcharts-tooltip-marker"
                                        style="background-color: rgba(113, 221, 55, 0.4);"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                                <div class="apexcharts-tooltip-series-group" style="order: 4;"><span
                                        class="apexcharts-tooltip-marker"
                                        style="background-color: rgba(113, 221, 55, 0.2);"></span>
                                    <div class="apexcharts-tooltip-text"
                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resize-triggers">
                        <div class="expand-trigger">
                            <div style="width: 455px; height: 449px;"></div>
                        </div>
                        <div class="contract-trigger"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-6 mb-4 order-1 order-xxl-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Bimbingan</h5>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="deliveryExceptions" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card" style="background-color: var(--bs-blue);">
                                <div
                                    class="card-header text-white d-flex justify-content-between align-items-center pb-1 pt-3">
                                    <strong class="me-auto">Bimbingan 3 </strong>
                                    <p class="mb-0 text-end">Senin, 02 Oktober 2023</p>
                                </div>
                                <div class="card mx-3 mb-3">
                                    <div class="row p-3 d-flex justify-content-between align-items-center">
                                        <div class="col-7 col-md-7 col-lg-8">
                                            <h6 class="mb-0">Bab 1.1 Latar Belakang</h6>
                                            <small class="mb-0">Dosen Pembimbing 1</small>
                                        </div>
                                        <div class="col-5 col-md-5 col-lg-4 text-end">
                                            <small class="mb-0" style="color: #007bff;">Mengunggu
                                                Konfirmasi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Pengumuman</h5>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="deliveryExceptions" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($jadwal)
                                <div class="card bg-success">
                                    <div class="mb-4 mt-3">
                                        <div class="mx-3 mb-auto text-white">
                                            <strong class="">Sidang Skripsi</strong>
                                            <p class="mb-0">Jadwal: {{ $jadwal->tanggal }}</p>
                                            <p>{{ $jadwal->keterangan }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card" style="background-color: var(--bs-gray);">
                                    <div class="mb-4 mt-3">
                                        <div class="mx-3 mb-auto">
                                            <p class="text-muted my-5 text-center">Belum Ada Pengumuman</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('button')

    <div class="mt-3">
        <div class="add-button">
            <button type="button" class="btn-add-button rounded-pill btn-icon btn-xl" data-bs-toggle="modal"
                data-bs-target="#modalCenter">
                <span class="tf-icons bx bx-plus bx-lg"></span>
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Bimbingan 1</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="basic-default-name" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="basic-default-name"
                                    value=" {{ $mahasiswa->nama }}" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nama Dosen</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option selected>Pilih Dosen</option>
                                    <option value="{{ $dosen1->nip }}">{{ $dosen1->nama }}</option>
                                    <option value="{{ $dosen2->nip }}">{{ $dosen2->nama }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Sub Bab</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option selected>Pilih Sub Bab</option>
                                    <option value="0">Abstrak</option>
                                    <option value="1">Bab 1.1 Latar Belakang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get current date
            var currentDate = new Date();

            // Create an array of month names
            var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                "September", "Oktober", "November", "Desember"
            ];

            // Get day, date, month, and year
            var dayName = getDayName(currentDate.getDay());
            var day = currentDate.getDate();
            var month = monthNames[currentDate.getMonth()];
            var year = currentDate.getFullYear();

            // Format the date as "day, dd bulan yyyy"
            var formattedDate = dayName + ", " + day + " " + month + " " + year;

            // Set the input value
            document.getElementById("basic-default-name").value = formattedDate;
        });

        // Function to get day name
        function getDayName(dayIndex) {
            var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            return dayNames[dayIndex];
        }
    </script>
@endsection
