PGDMP         9                z            GESTION_VEHICULAR    13.2    13.2 O               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    41034    GESTION_VEHICULAR    DATABASE     q   CREATE DATABASE "GESTION_VEHICULAR" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Ecuador.1252';
 #   DROP DATABASE "GESTION_VEHICULAR";
                postgres    false            �            1259    41150    asignacion_rol    TABLE     �   CREATE TABLE public.asignacion_rol (
    id_asignacion integer NOT NULL,
    id_rol integer,
    id_sub_modulo integer,
    id_modulo integer
);
 "   DROP TABLE public.asignacion_rol;
       public         heap    postgres    false            �            1259    41148     asignacion_rol_id_asignacion_seq    SEQUENCE     �   CREATE SEQUENCE public.asignacion_rol_id_asignacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.asignacion_rol_id_asignacion_seq;
       public          postgres    false    209                       0    0     asignacion_rol_id_asignacion_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.asignacion_rol_id_asignacion_seq OWNED BY public.asignacion_rol.id_asignacion;
          public          postgres    false    208            �            1259    49250    grupo_trabajo    TABLE     �   CREATE TABLE public.grupo_trabajo (
    grupo_id integer NOT NULL,
    nombre character varying(255),
    jefe_guardias_id integer,
    subalterno_id integer,
    cuartelero_id integer,
    fecha_creacion date,
    estatus integer
);
 !   DROP TABLE public.grupo_trabajo;
       public         heap    postgres    false            �            1259    49273    grupo_trabajo_detalle    TABLE     �   CREATE TABLE public.grupo_trabajo_detalle (
    grupo_detalle_id integer NOT NULL,
    personal_id integer,
    grupo_id integer
);
 )   DROP TABLE public.grupo_trabajo_detalle;
       public         heap    postgres    false            �            1259    49271 *   grupo_trabajo_detalle_grupo_detalle_id_seq    SEQUENCE     �   CREATE SEQUENCE public.grupo_trabajo_detalle_grupo_detalle_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 A   DROP SEQUENCE public.grupo_trabajo_detalle_grupo_detalle_id_seq;
       public          postgres    false    218                       0    0 *   grupo_trabajo_detalle_grupo_detalle_id_seq    SEQUENCE OWNED BY     y   ALTER SEQUENCE public.grupo_trabajo_detalle_grupo_detalle_id_seq OWNED BY public.grupo_trabajo_detalle.grupo_detalle_id;
          public          postgres    false    217            �            1259    49248    grupo_trabajo_grupo_id_seq    SEQUENCE     �   CREATE SEQUENCE public.grupo_trabajo_grupo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.grupo_trabajo_grupo_id_seq;
       public          postgres    false    216                       0    0    grupo_trabajo_grupo_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.grupo_trabajo_grupo_id_seq OWNED BY public.grupo_trabajo.grupo_id;
          public          postgres    false    215            �            1259    49228    jefe_guardias    TABLE     ,  CREATE TABLE public.jefe_guardias (
    jefe_guardias_id integer NOT NULL,
    nombre character varying(255),
    apellido character varying(255),
    correo character varying(255),
    cedula character varying(20),
    telefono character varying(30),
    fecha_creacion date,
    estatus integer
);
 !   DROP TABLE public.jefe_guardias;
       public         heap    postgres    false            �            1259    49226 "   jefe_guardias_jefe_guardias_id_seq    SEQUENCE     �   CREATE SEQUENCE public.jefe_guardias_jefe_guardias_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.jefe_guardias_jefe_guardias_id_seq;
       public          postgres    false    212                       0    0 "   jefe_guardias_jefe_guardias_id_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.jefe_guardias_jefe_guardias_id_seq OWNED BY public.jefe_guardias.jefe_guardias_id;
          public          postgres    false    211            �            1259    41129    modulos    TABLE     b   CREATE TABLE public.modulos (
    id_modulo integer NOT NULL,
    modulo character varying(20)
);
    DROP TABLE public.modulos;
       public         heap    postgres    false            �            1259    41127    modulos_id_modulo_seq    SEQUENCE     �   CREATE SEQUENCE public.modulos_id_modulo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.modulos_id_modulo_seq;
       public          postgres    false    205                       0    0    modulos_id_modulo_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.modulos_id_modulo_seq OWNED BY public.modulos.id_modulo;
          public          postgres    false    204            �            1259    41180    prueba    TABLE     6   CREATE TABLE public.prueba (
    id_modulo integer
);
    DROP TABLE public.prueba;
       public         heap    postgres    false            �            1259    41087    roles    TABLE        CREATE TABLE public.roles (
    id_rol integer NOT NULL,
    descripcion character varying(20) NOT NULL,
    estado integer
);
    DROP TABLE public.roles;
       public         heap    postgres    false            �            1259    41085    roles_id_rol_seq    SEQUENCE     �   CREATE SEQUENCE public.roles_id_rol_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.roles_id_rol_seq;
       public          postgres    false    201                       0    0    roles_id_rol_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.roles_id_rol_seq OWNED BY public.roles.id_rol;
          public          postgres    false    200            �            1259    41137    sub_modulos    TABLE     �   CREATE TABLE public.sub_modulos (
    id_sub_modulo integer NOT NULL,
    id_modulo integer,
    sub_modulo character varying(20)
);
    DROP TABLE public.sub_modulos;
       public         heap    postgres    false            �            1259    41135    sub_modulos_id_sub_modulo_seq    SEQUENCE     �   CREATE SEQUENCE public.sub_modulos_id_sub_modulo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.sub_modulos_id_sub_modulo_seq;
       public          postgres    false    207                       0    0    sub_modulos_id_sub_modulo_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.sub_modulos_id_sub_modulo_seq OWNED BY public.sub_modulos.id_sub_modulo;
          public          postgres    false    206            �            1259    49239 
   subalterno    TABLE     &  CREATE TABLE public.subalterno (
    subalterno_id integer NOT NULL,
    nombre character varying(255),
    apellido character varying(255),
    correo character varying(255),
    cedula character varying(20),
    telefono character varying(30),
    fecha_creacion date,
    estatus integer
);
    DROP TABLE public.subalterno;
       public         heap    postgres    false            �            1259    49237    subalterno_subalterno_id_seq    SEQUENCE     �   CREATE SEQUENCE public.subalterno_subalterno_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.subalterno_subalterno_id_seq;
       public          postgres    false    214                       0    0    subalterno_subalterno_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.subalterno_subalterno_id_seq OWNED BY public.subalterno.subalterno_id;
          public          postgres    false    213            �            1259    41095    usuarios    TABLE     <  CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    id_rol integer,
    nombres character varying(50) NOT NULL,
    correo character varying(100) NOT NULL,
    telefono character varying(10),
    usuario character varying(20) NOT NULL,
    clave character varying(20) NOT NULL,
    estado integer
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false            �            1259    41093    usuarios_id_usuario_seq    SEQUENCE     �   CREATE SEQUENCE public.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.usuarios_id_usuario_seq;
       public          postgres    false    203                        0    0    usuarios_id_usuario_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;
          public          postgres    false    202            \           2604    41153    asignacion_rol id_asignacion    DEFAULT     �   ALTER TABLE ONLY public.asignacion_rol ALTER COLUMN id_asignacion SET DEFAULT nextval('public.asignacion_rol_id_asignacion_seq'::regclass);
 K   ALTER TABLE public.asignacion_rol ALTER COLUMN id_asignacion DROP DEFAULT;
       public          postgres    false    209    208    209            _           2604    49253    grupo_trabajo grupo_id    DEFAULT     �   ALTER TABLE ONLY public.grupo_trabajo ALTER COLUMN grupo_id SET DEFAULT nextval('public.grupo_trabajo_grupo_id_seq'::regclass);
 E   ALTER TABLE public.grupo_trabajo ALTER COLUMN grupo_id DROP DEFAULT;
       public          postgres    false    215    216    216            `           2604    49276 &   grupo_trabajo_detalle grupo_detalle_id    DEFAULT     �   ALTER TABLE ONLY public.grupo_trabajo_detalle ALTER COLUMN grupo_detalle_id SET DEFAULT nextval('public.grupo_trabajo_detalle_grupo_detalle_id_seq'::regclass);
 U   ALTER TABLE public.grupo_trabajo_detalle ALTER COLUMN grupo_detalle_id DROP DEFAULT;
       public          postgres    false    217    218    218            ]           2604    49231    jefe_guardias jefe_guardias_id    DEFAULT     �   ALTER TABLE ONLY public.jefe_guardias ALTER COLUMN jefe_guardias_id SET DEFAULT nextval('public.jefe_guardias_jefe_guardias_id_seq'::regclass);
 M   ALTER TABLE public.jefe_guardias ALTER COLUMN jefe_guardias_id DROP DEFAULT;
       public          postgres    false    212    211    212            Z           2604    41132    modulos id_modulo    DEFAULT     v   ALTER TABLE ONLY public.modulos ALTER COLUMN id_modulo SET DEFAULT nextval('public.modulos_id_modulo_seq'::regclass);
 @   ALTER TABLE public.modulos ALTER COLUMN id_modulo DROP DEFAULT;
       public          postgres    false    205    204    205            X           2604    41090    roles id_rol    DEFAULT     l   ALTER TABLE ONLY public.roles ALTER COLUMN id_rol SET DEFAULT nextval('public.roles_id_rol_seq'::regclass);
 ;   ALTER TABLE public.roles ALTER COLUMN id_rol DROP DEFAULT;
       public          postgres    false    201    200    201            [           2604    41140    sub_modulos id_sub_modulo    DEFAULT     �   ALTER TABLE ONLY public.sub_modulos ALTER COLUMN id_sub_modulo SET DEFAULT nextval('public.sub_modulos_id_sub_modulo_seq'::regclass);
 H   ALTER TABLE public.sub_modulos ALTER COLUMN id_sub_modulo DROP DEFAULT;
       public          postgres    false    207    206    207            ^           2604    49242    subalterno subalterno_id    DEFAULT     �   ALTER TABLE ONLY public.subalterno ALTER COLUMN subalterno_id SET DEFAULT nextval('public.subalterno_subalterno_id_seq'::regclass);
 G   ALTER TABLE public.subalterno ALTER COLUMN subalterno_id DROP DEFAULT;
       public          postgres    false    213    214    214            Y           2604    41098    usuarios id_usuario    DEFAULT     z   ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);
 B   ALTER TABLE public.usuarios ALTER COLUMN id_usuario DROP DEFAULT;
       public          postgres    false    202    203    203                      0    41150    asignacion_rol 
   TABLE DATA           Y   COPY public.asignacion_rol (id_asignacion, id_rol, id_sub_modulo, id_modulo) FROM stdin;
    public          postgres    false    209   (b                 0    49250    grupo_trabajo 
   TABLE DATA           �   COPY public.grupo_trabajo (grupo_id, nombre, jefe_guardias_id, subalterno_id, cuartelero_id, fecha_creacion, estatus) FROM stdin;
    public          postgres    false    216   Ob                 0    49273    grupo_trabajo_detalle 
   TABLE DATA           X   COPY public.grupo_trabajo_detalle (grupo_detalle_id, personal_id, grupo_id) FROM stdin;
    public          postgres    false    218   �b                 0    49228    jefe_guardias 
   TABLE DATA           ~   COPY public.jefe_guardias (jefe_guardias_id, nombre, apellido, correo, cedula, telefono, fecha_creacion, estatus) FROM stdin;
    public          postgres    false    212   �b                 0    41129    modulos 
   TABLE DATA           4   COPY public.modulos (id_modulo, modulo) FROM stdin;
    public          postgres    false    205    c       	          0    41180    prueba 
   TABLE DATA           +   COPY public.prueba (id_modulo) FROM stdin;
    public          postgres    false    210   -c                  0    41087    roles 
   TABLE DATA           <   COPY public.roles (id_rol, descripcion, estado) FROM stdin;
    public          postgres    false    201   Lc                 0    41137    sub_modulos 
   TABLE DATA           K   COPY public.sub_modulos (id_sub_modulo, id_modulo, sub_modulo) FROM stdin;
    public          postgres    false    207   �c                 0    49239 
   subalterno 
   TABLE DATA           x   COPY public.subalterno (subalterno_id, nombre, apellido, correo, cedula, telefono, fecha_creacion, estatus) FROM stdin;
    public          postgres    false    214   �c                 0    41095    usuarios 
   TABLE DATA           i   COPY public.usuarios (id_usuario, id_rol, nombres, correo, telefono, usuario, clave, estado) FROM stdin;
    public          postgres    false    203   d       !           0    0     asignacion_rol_id_asignacion_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.asignacion_rol_id_asignacion_seq', 23, true);
          public          postgres    false    208            "           0    0 *   grupo_trabajo_detalle_grupo_detalle_id_seq    SEQUENCE SET     X   SELECT pg_catalog.setval('public.grupo_trabajo_detalle_grupo_detalle_id_seq', 1, true);
          public          postgres    false    217            #           0    0    grupo_trabajo_grupo_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.grupo_trabajo_grupo_id_seq', 1, true);
          public          postgres    false    215            $           0    0 "   jefe_guardias_jefe_guardias_id_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.jefe_guardias_jefe_guardias_id_seq', 1, true);
          public          postgres    false    211            %           0    0    modulos_id_modulo_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.modulos_id_modulo_seq', 1, true);
          public          postgres    false    204            &           0    0    roles_id_rol_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.roles_id_rol_seq', 8, true);
          public          postgres    false    200            '           0    0    sub_modulos_id_sub_modulo_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.sub_modulos_id_sub_modulo_seq', 2, true);
          public          postgres    false    206            (           0    0    subalterno_subalterno_id_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.subalterno_subalterno_id_seq', 1, true);
          public          postgres    false    213            )           0    0    usuarios_id_usuario_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 15, true);
          public          postgres    false    202            j           2606    41155 "   asignacion_rol asignacion_rol_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.asignacion_rol
    ADD CONSTRAINT asignacion_rol_pkey PRIMARY KEY (id_asignacion);
 L   ALTER TABLE ONLY public.asignacion_rol DROP CONSTRAINT asignacion_rol_pkey;
       public            postgres    false    209            r           2606    49278 0   grupo_trabajo_detalle grupo_trabajo_detalle_pkey 
   CONSTRAINT     |   ALTER TABLE ONLY public.grupo_trabajo_detalle
    ADD CONSTRAINT grupo_trabajo_detalle_pkey PRIMARY KEY (grupo_detalle_id);
 Z   ALTER TABLE ONLY public.grupo_trabajo_detalle DROP CONSTRAINT grupo_trabajo_detalle_pkey;
       public            postgres    false    218            p           2606    49255     grupo_trabajo grupo_trabajo_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.grupo_trabajo
    ADD CONSTRAINT grupo_trabajo_pkey PRIMARY KEY (grupo_id);
 J   ALTER TABLE ONLY public.grupo_trabajo DROP CONSTRAINT grupo_trabajo_pkey;
       public            postgres    false    216            l           2606    49236     jefe_guardias jefe_guardias_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.jefe_guardias
    ADD CONSTRAINT jefe_guardias_pkey PRIMARY KEY (jefe_guardias_id);
 J   ALTER TABLE ONLY public.jefe_guardias DROP CONSTRAINT jefe_guardias_pkey;
       public            postgres    false    212            f           2606    41134    modulos modulos_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.modulos
    ADD CONSTRAINT modulos_pkey PRIMARY KEY (id_modulo);
 >   ALTER TABLE ONLY public.modulos DROP CONSTRAINT modulos_pkey;
       public            postgres    false    205            b           2606    41092    roles roles_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id_rol);
 :   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_pkey;
       public            postgres    false    201            h           2606    41142    sub_modulos sub_modulos_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.sub_modulos
    ADD CONSTRAINT sub_modulos_pkey PRIMARY KEY (id_sub_modulo);
 F   ALTER TABLE ONLY public.sub_modulos DROP CONSTRAINT sub_modulos_pkey;
       public            postgres    false    207            n           2606    49247    subalterno subalterno_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.subalterno
    ADD CONSTRAINT subalterno_pkey PRIMARY KEY (subalterno_id);
 D   ALTER TABLE ONLY public.subalterno DROP CONSTRAINT subalterno_pkey;
       public            postgres    false    214            d           2606    41100    usuarios usuarios_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public            postgres    false    203            w           2606    41166 ,   asignacion_rol asignacion_rol_id_modulo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.asignacion_rol
    ADD CONSTRAINT asignacion_rol_id_modulo_fkey FOREIGN KEY (id_modulo) REFERENCES public.modulos(id_modulo);
 V   ALTER TABLE ONLY public.asignacion_rol DROP CONSTRAINT asignacion_rol_id_modulo_fkey;
       public          postgres    false    209    205    2918            u           2606    41156 )   asignacion_rol asignacion_rol_id_rol_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.asignacion_rol
    ADD CONSTRAINT asignacion_rol_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES public.roles(id_rol);
 S   ALTER TABLE ONLY public.asignacion_rol DROP CONSTRAINT asignacion_rol_id_rol_fkey;
       public          postgres    false    2914    209    201            v           2606    41161 0   asignacion_rol asignacion_rol_id_sub_modulo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.asignacion_rol
    ADD CONSTRAINT asignacion_rol_id_sub_modulo_fkey FOREIGN KEY (id_sub_modulo) REFERENCES public.sub_modulos(id_sub_modulo);
 Z   ALTER TABLE ONLY public.asignacion_rol DROP CONSTRAINT asignacion_rol_id_sub_modulo_fkey;
       public          postgres    false    2920    207    209            z           2606    49266 .   grupo_trabajo grupo_trabajo_cuartelero_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.grupo_trabajo
    ADD CONSTRAINT grupo_trabajo_cuartelero_id_fkey FOREIGN KEY (cuartelero_id) REFERENCES public.usuarios(id_usuario);
 X   ALTER TABLE ONLY public.grupo_trabajo DROP CONSTRAINT grupo_trabajo_cuartelero_id_fkey;
       public          postgres    false    2916    216    203            |           2606    49284 9   grupo_trabajo_detalle grupo_trabajo_detalle_grupo_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.grupo_trabajo_detalle
    ADD CONSTRAINT grupo_trabajo_detalle_grupo_id_fkey FOREIGN KEY (grupo_id) REFERENCES public.grupo_trabajo(grupo_id);
 c   ALTER TABLE ONLY public.grupo_trabajo_detalle DROP CONSTRAINT grupo_trabajo_detalle_grupo_id_fkey;
       public          postgres    false    2928    216    218            {           2606    49279 <   grupo_trabajo_detalle grupo_trabajo_detalle_personal_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.grupo_trabajo_detalle
    ADD CONSTRAINT grupo_trabajo_detalle_personal_id_fkey FOREIGN KEY (personal_id) REFERENCES public.usuarios(id_usuario);
 f   ALTER TABLE ONLY public.grupo_trabajo_detalle DROP CONSTRAINT grupo_trabajo_detalle_personal_id_fkey;
       public          postgres    false    2916    203    218            x           2606    49256 1   grupo_trabajo grupo_trabajo_jefe_guardias_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.grupo_trabajo
    ADD CONSTRAINT grupo_trabajo_jefe_guardias_id_fkey FOREIGN KEY (jefe_guardias_id) REFERENCES public.jefe_guardias(jefe_guardias_id);
 [   ALTER TABLE ONLY public.grupo_trabajo DROP CONSTRAINT grupo_trabajo_jefe_guardias_id_fkey;
       public          postgres    false    2924    216    212            y           2606    49261 .   grupo_trabajo grupo_trabajo_subalterno_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.grupo_trabajo
    ADD CONSTRAINT grupo_trabajo_subalterno_id_fkey FOREIGN KEY (subalterno_id) REFERENCES public.subalterno(subalterno_id);
 X   ALTER TABLE ONLY public.grupo_trabajo DROP CONSTRAINT grupo_trabajo_subalterno_id_fkey;
       public          postgres    false    216    2926    214            t           2606    41143 &   sub_modulos sub_modulos_id_modulo_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.sub_modulos
    ADD CONSTRAINT sub_modulos_id_modulo_fkey FOREIGN KEY (id_modulo) REFERENCES public.modulos(id_modulo);
 P   ALTER TABLE ONLY public.sub_modulos DROP CONSTRAINT sub_modulos_id_modulo_fkey;
       public          postgres    false    205    2918    207            s           2606    41101    usuarios usuarios_id_rol_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES public.roles(id_rol);
 G   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_id_rol_fkey;
       public          postgres    false    2914    203    201                  x�32�4�4������� >         '   x�3�t
�W�S0�@###]s]CcNC�=... |�            x�3�44�4����� �         F   x�3�J�K���MM��K�,q2�Kr3s���s9��M,LM�8c�8���t�u�8�b���� �9�            x�3�t��K�L/-JL�������� K�4      	      x�3����� Z �          +   x�3�tt����	rt��4�2�ruvp����b���� ��         "   x�3�4���I-�2�B�K�2�b���� f�         D   x�3�tI��tL/M,�LI�s��/�M���K���4047�0�040���4202�50�54�4����� X�         `   x�3�4�����Spt��sv���O�I��54w��/�M���K���4��051�071*���442�4�24�4�t�q��L�/*J�G��	2	�4F��� ^A�     