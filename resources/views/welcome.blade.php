<!DOCTYPE html>
<html lang="en" class="dark">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HUEMENT LABS // CYBER OS</title>
    <meta name="title" content="HUEMENT LABS // CYBER OS">
    <meta name="description" content="Huement WebDev TestBed Laboratory">
    <meta name="theme-color" content="#05050a">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <!-- Google Fonts: Orbitron & Share Tech Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap"
        rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Tailwind CSS (v3 CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        orbitron: ['Orbitron', 'sans-serif'],
                        mono: ['Share Tech Mono', 'monospace'],
                    },
                    colors: {
                        cyber: {
                            black: '#05050a',
                            dark: '#0a0a14',
                            cyan: '#00f0ff',
                            magenta: '#ff0055',
                            yellow: '#ffe600',
                            purple: '#7000ff'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom Cyberpunk FX CSS -->
    <style>
        .scanlines {
            background: linear-gradient(to bottom,
                    rgba(255, 255, 255, 0),
                    rgba(255, 255, 255, 0) 50%,
                    rgba(0, 0, 0, 0.3) 50%,
                    rgba(0, 0, 0, 0.3));
            background-size: 100% 4px;
        }

        .cyber-tile {
            clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 12px, 100% 100%, 12px 100%, 0 calc(100% - 12px));
        }

        .cyber-btn {
            clip-path: polygon(12px 0, 100% 0, 100% calc(100% - 12px), calc(100% - 12px) 100%, 0 100%, 0 12px);
        }

        .bg-grid {
            background-size: 30px 30px;
            background-image:
                linear-gradient(to right, rgba(0, 240, 255, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 240, 255, 0.05) 1px, transparent 1px);
        }

        .glow-cyan {
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.25), inset 0 0 10px rgba(0, 240, 255, 0.1);
        }

        .glow-magenta {
            box-shadow: 0 0 15px rgba(255, 0, 85, 0.25), inset 0 0 10px rgba(255, 0, 85, 0.1);
        }

        .glow-yellow {
            box-shadow: 0 0 15px rgba(255, 230, 0, 0.25), inset 0 0 10px rgba(255, 230, 0, 0.1);
        }

        .no-select {
            user-select: none;
        }
    </style>

    <!-- React 18 & Babel CDN -->
    <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

    <!-- Bridge Laravel variables into JS -->
    <script>
        window.APP_CONFIG = {
            splashUrl: "{{ asset('splash.png') }}",
            cookieTestUrl: "{{ url('/cookie-test') }}"
        };
    </script>
</head>

<body
    class="bg-cyber-black text-slate-200 font-mono antialiased min-h-screen overflow-hidden relative selection:bg-cyber-cyan selection:text-black">

    <div class="fixed inset-0 bg-grid pointer-events-none z-0"></div>
    <div class="fixed inset-0 scanlines pointer-events-none z-10 opacity-60"></div>

    <div id="root" class="relative z-20 h-screen w-screen"></div>

    @verbatim
        <script type="text/babel">
        const { useState, useEffect } = React;

        const INITIAL_WINDOWS = [
            {
                id: 'splash-center',
                title: 'MAIN_SPLASH // SYSTEM_VIEW',
                desc: 'Huement WebDev TestBed Center Visual Interface.',
                icon: 'bx-shield-quarter',
                type: 'splash',
                color: 'cyan',
                x: Math.max(20, Math.floor(window.innerWidth / 2 - 260)),
                y: 80,
                width: 520,
                zIndex: 10,
                isMinimized: false,
            },
            {
                id: 'cookie-test',
                title: 'COOKIE_DIAGNOSTICS',
                desc: 'Execute real-time HTTP/HTTPS domain session cookie encryption & persistence tests.',
                link: window.APP_CONFIG.cookieTestUrl,
                cta: 'RUN_DIAGNOSTICS',
                icon: 'bx-cookie',
                color: 'magenta',
                x: 60,
                y: 120,
                width: 380,
                zIndex: 5,
                isMinimized: false,
            },
            {
                id: 'huement-main',
                title: 'HUEMENT_MAINFRAME',
                desc: 'Access the core production suite and production agency environment.',
                link: 'https://huement.com',
                cta: 'CONNECT_MAINFRAME',
                icon: 'bx-planet',
                color: 'cyan',
                x: window.innerWidth - 440 > 0 ? window.innerWidth - 440 : 20,
                y: 140,
                width: 380,
                zIndex: 6,
                isMinimized: false,
            },
            {
                id: 'barebones-code',
                title: 'BAREBONES_CODE // YT',
                desc: 'Watch raw development streams, system architecture builds, and live tutorials.',
                link: 'https://youtube.com/@barebonescode',
                cta: 'LAUNCH_FEED',
                icon: 'bxl-youtube',
                color: 'yellow',
                x: Math.max(40, Math.floor(window.innerWidth / 2 - 190)),
                y: window.innerHeight - 320 > 0 ? window.innerHeight - 320 : 300,
                width: 380,
                zIndex: 7,
                isMinimized: false,
            }
        ];

        function CyberDesktop() {
            const [windows, setWindows] = useState(INITIAL_WINDOWS);
            const [highestZ, setHighestZ] = useState(20);
            const [dragState, setDragState] = useState(null);

            const focusWindow = (id) => {
                const nextZ = highestZ + 1;
                setHighestZ(nextZ);
                setWindows(prev => prev.map(w => w.id === id ? { ...w, zIndex: nextZ } : w));
            };

            const toggleMinimize = (id, e) => {
                e.stopPropagation();
                setWindows(prev => prev.map(w => w.id === id ? { ...w, isMinimized: !w.isMinimized } : w));
            };

            const handleMouseDown = (id, e) => {
                focusWindow(id);
                const win = windows.find(w => w.id === id);
                setDragState({
                    id,
                    startX: e.clientX,
                    startY: e.clientY,
                    initialWinX: win.x,
                    initialWinY: win.y
                });
            };

            useEffect(() => {
                const handleMouseMove = (e) => {
                    if (!dragState) return;
                    const deltaX = e.clientX - dragState.startX;
                    const deltaY = e.clientY - dragState.startY;

                    setWindows(prev => prev.map(w => {
                        if (w.id === dragState.id) {
                            return {
                                ...w,
                                x: Math.max(10, dragState.initialWinX + deltaX),
                                y: Math.max(50, dragState.initialWinY + deltaY)
                            };
                        }
                        return w;
                    }));
                };

                const handleMouseUp = () => {
                    setDragState(null);
                };

                if (dragState) {
                    window.addEventListener('mousemove', handleMouseMove);
                    window.addEventListener('mouseup', handleMouseUp);
                }

                return () => {
                    window.removeEventListener('mousemove', handleMouseMove);
                    window.removeEventListener('mouseup', handleMouseUp);
                };
            }, [dragState]);

            return (
                <div className="h-full w-full relative flex flex-col justify-between overflow-hidden">
                    <header className="h-12 border-b border-cyber-cyan/30 bg-cyber-dark/80 backdrop-blur-md px-4 flex items-center justify-between z-50 no-select">
                        <div className="flex items-center space-x-3">
                            <div className="w-3 h-3 bg-cyber-cyan animate-pulse rounded-full shadow-[0_0_8px_#00f0ff]"></div>
                            <span className="font-orbitron font-bold text-cyber-cyan tracking-wider text-sm">
                                HUEMENT LABS <span className="text-slate-500">//</span> TESTBED_v2.6
                            </span>
                        </div>

                        <div className="hidden md:flex items-center space-x-6 text-xs text-slate-400">
                            <div>SYS_STATUS: <span className="text-emerald-400 font-bold">ONLINE</span></div>
                            <div>ENCRYPTION: <span className="text-cyber-cyan">TLS_1.3</span></div>
                            <div>SERVER: <span className="text-cyber-yellow">FRANKENPHP</span></div>
                        </div>

                        <div className="flex items-center space-x-2">
                            {windows.map(w => (
                                <button
                                    key={w.id}
                                    onClick={() => {
                                        focusWindow(w.id);
                                        if (w.isMinimized) toggleMinimize(w.id, { stopPropagation: () => {} });
                                    }}
                                    className={`px-2.5 py-1 text-xs border transition-all duration-150 flex items-center space-x-1 ${
                                        !w.isMinimized 
                                            ? 'border-cyber-cyan bg-cyber-cyan/10 text-cyber-cyan' 
                                            : 'border-slate-800 bg-black/40 text-slate-500 hover:border-slate-600'
                                    }`}
                                >
                                    <i className={`bx ${w.icon}`}></i>
                                    <span className="hidden sm:inline font-orbitron text-[10px] uppercase">{w.title.split(' ')[0]}</span>
                                </button>
                            ))}
                        </div>
                    </header>

                    <main className="flex-1 relative w-full h-full overflow-hidden">
                        {windows.map(win => {
                            if (win.isMinimized) return null;

                            const themeGlow = win.color === 'magenta' 
                                ? 'border-cyber-magenta/50 glow-magenta' 
                                : win.color === 'yellow' 
                                ? 'border-cyber-yellow/50 glow-yellow' 
                                : 'border-cyber-cyan/50 glow-cyan';

                            const headerBg = win.color === 'magenta' 
                                ? 'bg-cyber-magenta/20 border-cyber-magenta/40 text-cyber-magenta' 
                                : win.color === 'yellow' 
                                ? 'bg-cyber-yellow/20 border-cyber-yellow/40 text-cyber-yellow' 
                                : 'bg-cyber-cyan/20 border-cyber-cyan/40 text-cyber-cyan';

                            const btnStyle = win.color === 'magenta' 
                                ? 'bg-cyber-magenta text-black hover:bg-white shadow-[0_0_10px_#ff0055]' 
                                : win.color === 'yellow' 
                                ? 'bg-cyber-yellow text-black hover:bg-white shadow-[0_0_10px_#ffe600]' 
                                : 'bg-cyber-cyan text-black hover:bg-white shadow-[0_0_10px_#00f0ff]';

                            return (
                                <div
                                    key={win.id}
                                    onClick={() => focusWindow(win.id)}
                                    style={{
                                        position: 'absolute',
                                        left: `${win.x}px`,
                                        top: `${win.y}px`,
                                        width: `${win.width}px`,
                                        zIndex: win.zIndex,
                                    }}
                                    className={`cyber-tile bg-cyber-dark/90 backdrop-blur-md border ${themeGlow} rounded-sm overflow-hidden transition-shadow duration-200`}
                                >
                                    <div
                                        onMouseDown={(e) => handleMouseDown(win.id, e)}
                                        className={`h-9 px-3 border-b flex items-center justify-between cursor-grab active:cursor-grabbing no-select ${headerBg}`}
                                    >
                                        <div className="flex items-center space-x-2 truncate">
                                            <i className={`bx ${win.icon} text-base`}></i>
                                            <span className="font-orbitron text-xs font-bold tracking-wider truncate">
                                                {win.title}
                                            </span>
                                        </div>

                                        <div className="flex items-center space-x-1.5 pl-2">
                                            <button
                                                onClick={(e) => toggleMinimize(win.id, e)}
                                                className="w-5 h-5 flex items-center justify-center border border-current opacity-70 hover:opacity-100 text-xs"
                                                title="Minimize"
                                            >
                                                _
                                            </button>
                                        </div>
                                    </div>

                                    <div className="p-4 space-y-4">
                                        {win.type === 'splash' ? (
                                            <div className="space-y-3">
                                                <div className="relative group overflow-hidden border border-cyber-cyan/30">
                                                    <img 
                                                        src={window.APP_CONFIG.splashUrl} 
                                                        alt="Huement Labs Splash" 
                                                        className="w-full h-auto max-h-[280px] object-cover transition-transform duration-500 group-hover:scale-105"
                                                    />
                                                    <div className="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80"></div>
                                                    <div className="absolute bottom-2 left-3 right-3 text-xs text-cyber-cyan font-mono flex justify-between">
                                                        <span>STATUS: ACTIVE</span>
                                                        <span>NODE: 01</span>
                                                    </div>
                                                </div>
                                                <p className="text-xs text-slate-400 leading-relaxed">
                                                    {win.desc}
                                                </p>
                                            </div>
                                        ) : (
                                            <div className="space-y-4">
                                                <p className="text-xs text-slate-300 leading-relaxed font-mono">
                                                    {win.desc}
                                                </p>

                                                <div className="pt-2">
                                                    <a
                                                        href={win.link}
                                                        target={win.link.startsWith('http') && !win.link.includes('labs.huement.com') ? "_blank" : "_self"}
                                                        rel="noopener noreferrer"
                                                        className={`cyber-btn inline-flex items-center justify-between w-full px-4 py-2.5 font-orbitron text-xs font-bold tracking-wider uppercase transition-all duration-200 ${btnStyle}`}
                                                    >
                                                        <span>{win.cta}</span>
                                                        <i className="bx bx-right-arrow-alt text-lg"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        )}
                                    </div>

                                    <div className="px-3 py-1 bg-black/60 border-t border-slate-800/80 text-[10px] text-slate-500 flex justify-between font-mono">
                                        <span>SEC_LEVEL: 0</span>
                                        <span>ID: {win.id}</span>
                                    </div>
                                </div>
                            );
                        })}
                    </main>

                    <footer className="h-8 border-t border-slate-800 bg-cyber-black px-4 flex items-center justify-between text-[11px] text-slate-500 font-mono no-select z-50">
                        <div>
                            HUEMENT LABS ENGINE &copy; {new Date().getFullYear()}
                        </div>
                        <div className="flex items-center space-x-4">
                            <span className="hover:text-cyber-cyan cursor-pointer">DRAG_WINDOWS: ENABLED</span>
                            <span className="text-slate-700">|</span>
                            <span className="hover:text-cyber-magenta cursor-pointer">PROTOCOL: HTTP/2</span>
                        </div>
                    </footer>
                </div>
            );
        }

        const rootElement = document.getElementById('root');
        const root = ReactDOM.createRoot(rootElement);
        root.render(<CyberDesktop />);
    </script>
    @endverbatim
</body>

</html>
